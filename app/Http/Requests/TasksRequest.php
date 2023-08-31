<?php
namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TasksRequest extends FormRequest {

	/**

	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}

	/**

	 * Get the validation rules that apply to the request.
	 *
	 * @return array (onCreate,onUpdate,rules) methods
	 */
	protected function onCreate() {
		return [
			'name'=>'required|max:100',
			'start_date'=>'required|date|date_format:Y-m-d|after_or_equal:now|before:end_date',
			'end_date'=>'required|date|date_format:Y-m-d|after_or_equal:now|after:start_date',
		];
	}

	protected function onUpdate() {
		return [
			'name'=>'required|max:100',
			'start_date'=>'required|date|date_format:Y-m-d|after_or_equal:now|before:end_date',
			'end_date'=>'required|date|date_format:Y-m-d|after_or_equal:now|after:start_date',
		];
	}

	public function rules() {
		return request()->isMethod('put') || request()->isMethod('patch') ?
		$this->onUpdate() : $this->onCreate();
	}


	/**

	 * Get the validation attributes that apply to the request.
	 *
	 * @return array
	 */
	public function attributes() {
		return [
            'name'=>trans('admin.name'),
		];
	}

	/**

	 * response redirect if fails or failed request
	 *
	 * @return redirect
	 */
	public function response(array $errors) {
		return $this->ajax() || $this->wantsJson() ?
		response([
			'status' => false,
			'StatusCode' => 422,
			'StatusType' => 'Unprocessable',
			'errors' => $errors,
		], 422) :
		back()->withErrors($errors)->withInput(); // Redirect back
	}



}
