<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateGeneratorRequest;
use Flash;
use Mitul\Controller\AppBaseController as AppBaseController;
use Response;
use Artisan;
use Illuminate\Support\Str;
use Storage;
use Schema;

class GeneratorController extends AppBaseController
{

	/**
	 * Display a listing of the Generator.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new Generator.
	 *
	 * @return Response
	 */
	public function create()
	{
		$objects = [];
		$object_fields = [];
		if(is_dir(base_path("app/Models/"))){
			$files = scandir(base_path("app/Models/"));
			foreach ($files as $key => $row) {
				if($key > 1){
					$name = basename($row,".php");
					$columns = Schema::getColumnListing(Str::camel(Str::plural($name)));
					$objects[$name] = $name;
					$object_columns = [];
					foreach ($columns as $key => $value) {
						$object_columns[$value] = $value;
					}
					$object_fields[] = $object_columns;
				}
				
			}
		}
		return view('generators.create')->with(['objects'=>$objects,'object_fields'=>$object_fields]);
	}

	/**
	 * Store a newly created Generator in storage.
	 *
	 * @param CreateGeneratorRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateGeneratorRequest $request)
	{
		$input = $request->all();

		if(!$input['model_name']){
			Flash::error('Required model name field.');
			return redirect(route('administration.generators.create'));
		}

		$json_arr = array();
		$option = array();
		foreach ($input['field_name'] as $key => $field) {
			if($field){
				$field = str_replace(' ', '_', $field);
				$json_arr[$key]['field'] 		= $field.":".$input['data_type'][$key];
				if($input['field_type'][$key] == 'checkbox' || $input['field_type'][$key] == 'radio' || $input['field_type'][$key] == 'select'){
					$json_arr[$key]['type'] = $input['field_type'][$key].":".$input['value'][$key];
				}elseif($input['field_type'][$key] == 'pointer'){
					$json_arr[$key]['type'] = $input['field_type'][$key].":".$input['pointer'][$key].",".$input['pointer_column'][$key];
					$option['--pointerModel'] = true;
				}else{
					$json_arr[$key]['type'] = $input['field_type'][$key];
				}
				$json_arr[$key]['validations'] 	= isset($input['is_required'][$key]) ? 'required' : '';
			}
		}
		if(count($json_arr) > 0){
			
			$option['model'] = str_replace(' ', '_', $input['model_name']);
			$option['--fieldsData'] = $json_arr;
			if(isset($input['set_paginater']) && $input['set_paginater']){
				$option['--paginate'] = 10;
			}
			if(isset($input['add_soft_delete']) && $input['add_soft_delete']){
				$option['--softDelete'] = true;
			}
			if(isset($input['has_access_token']) && $input['has_access_token']){
				$option['--rememberToken'] = true;
			}
			if(isset($input['skip_migration']) && $input['skip_migration']){
				$option['--skipMigration'] = true;
			}
			if(isset($input['scaffold']) && $input['scaffold'] && isset($input['has_api']) && $input['has_api']){
				Artisan::call('mitul.generator:scaffold_api',$option);
			}elseif(isset($input['scaffold']) && $input['scaffold']){
				Artisan::call('mitul.generator:scaffold',$option);
			}elseif(isset($input['has_api']) && $input['has_api']){
				Artisan::call('mitul.generator:api',$option);
			}else{
				Flash::error('Required 1 scaffold or API.');
			}

			$generator_model['name'] = $input['model_name'];
			$generator_model['field'] = $json_arr;
			$generator_model['option'] = $option;

			$this->saveFile($input['model_name'], $generator_model);

			Flash::success($input['model_name'].' generated successfully.');

			return redirect(route('administration.generators.create'));
		}
		
		Flash::error('Required more than 1 field.');
		return redirect(route('administration.generators.create'));
		
	}

	/**
	 * Display the specified Generator.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified Generator.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified Generator in storage.
	 *
	 * @param  int              $id
	 * @param UpdateGeneratorRequest $request
	 *
	 * @return Response
	 */
	public function update($id, UpdateGeneratorRequest $request)
	{
		//
	}

	/**
	 * Remove the specified Generator from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	/**
     * To Read from Json File.
     */
    public function readJson($fileName){
        $file = "generator_models/".$fileName.'.json';
        if(file_exists($file)){
            $jsonString = file_get_contents($file);
            $jsonArr = json_decode($jsonString,true);
            return $jsonArr;
        }else{
            return array();
        }
        
    }

    /**
	 * To Save File as JSON File.
	 */
	public function saveFile($fileName,$array){
		if($fileName && is_array($array)){
			try {
				$fileDir = "generator_models/".$fileName.'.json';
				$fileData = fopen($fileDir, 'w+');
				fwrite($fileData, json_encode($array));
				fclose($fileData);
				chmod($fileDir,0777);
			} catch (Exception $e) {
				return $e;
			}
			
		}
	}
}
