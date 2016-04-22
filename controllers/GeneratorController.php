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
			return redirect(route('admin.generators.create'));
		}

		$json_arr = array();
		$option = array();
		foreach ($input['field_name'] as $key => $field) {
			if($field){
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
			
			$option['model'] = $input['model_name'];
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
			if(isset($input['has_api']) && $input['has_api']){
				Artisan::call('mitul.generator:scaffold_api',$option);
			}else{
				Artisan::call('mitul.generator:scaffold',$option);
			}

			Flash::success($input['model_name'].' generated successfully.');

			return redirect(route('admin.generators.create'));
		}
		Flash::error('Required more than 1 field.');
		return redirect(route('admin.generators.create'));
		
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
}
