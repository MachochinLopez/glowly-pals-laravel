<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
	protected $modelName = 'Usuario';


	public function login()
	{
		$user = User::where('name', request()->name)->first();

		// Si sí existe un usuario con ese nombre...
		if ($user) {
			$isPasswordCorrect = password_verify(request()->password, $user->password);

			// Si la contraseña sea correcta...
			if ($isPasswordCorrect) {
				$responseData = [
					'state' => 'success',
					'data' => $user
				];
			} else {
				$responseData = [
					'state' => 'error',
					'errors' => [
						'Credenciales incorrectas.'
					]
				];
			}
		} else {
			$responseData = [
				'state' => 'error',
				'errors' => [
					'No existe un usuario con ese nombre.'
				]
			];
		}

		return response()->json($responseData);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		// Busca todos los usuarios.
		$users = User::all()->map(function ($user) {
			// Y devuelve cada uno con el formato esperado.
			return $user->formatted();
		});

		return response()->json([
			'data' => $users,
		]);
	}

	/**
	 * Crear un nuevo usuario.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store()
	{
		$validatedData = $this->validateRequest();

		// Si pasa la validación...
		if ($validatedData['state'] == 'success') {
			$responseData = [
				'state' => $validatedData['state'],
				'message' => __(
					'validation.success_messages.masculine.create',
					['modelName' => $this->modelName]
				),
				// Crea la unidad.
				'data' => User::create([
					'name' => request()->name,
					// Encripta la password.
					'password' => password_hash(request()->password, PASSWORD_DEFAULT),
				])->formatted()
			];
		}
		// Si no...
		else {
			$responseData = [
				'state' => $validatedData['state'],
				// Devuelve los errores de validación..
				'errors' => $validatedData['errors'],
			];
		}

		return response()->json($responseData);
	}

	/**
	 * Muestra el detalle individual de una unidad.
	 * 
	 * @param int $id user Id
	 * @return json
	 */
	public function show($id)
	{
		$user = User::find($id);

		// Si la unidad existe...
		if ($user) {
			$responseData = [
				'state' => 'success',
				'data' => $user->formatted(),
			];
		}
		// Si no...
		else {
			$responseData = [
				'state' => 'error',
				// Devuelve los errores de validación..
				'errors' => [
					__(
						'validation.exists',
						['attribute' => $this->modelName]
					)
				],
			];
		}

		return response()->json($responseData);
	}

	/**
	 * Actualiza una unidad existente.
	 * 
	 * @param int $id user Id
	 * @return json
	 */
	public function update($id)
	{
		$user = User::find($id);

		// Si la unidad existe...
		if ($user) {
			$validatedData = $this->validateRequest();

			// Si pasa la validación...
			if ($validatedData['state'] == 'success') {

				if (request()->password) {
					$user->password = password_hash(request()->password, PASSWORD_DEFAULT);
				}
				// Actualiza el registro.
				$user->update(request()->all());

				$responseData = [
					'state' => $validatedData['state'],
					'message' => __(
						'validation.success_messages.masculine.edit',
						['modelName' => $this->modelName]
					),
					'data' => $user->formatted(),
				];
			}
			// Si no...
			else {
				$responseData = [
					'state' => $validatedData['state'],
					// Devuelve los errores de validación..
					'errors' => $validatedData['errors'],
				];
			}
		}
		// Si no...
		else {
			$responseData = [
				'state' => 'error',
				// Devuelve los errores de validación..
				'errors' => [
					__(
						'validation.exists',
						['attribute' => $this->modelName]
					)
				],
			];
		}

		return response()->json($responseData);
	}

	/**
	 * Elimina una unidad.
	 * 
	 * @param int $id user Id
	 * @return json
	 */
	public function delete($id)
	{
		$user = User::find($id);

		// Si existe la unidad...
		if ($user) {
			// La elimina.
			$user->delete();

			$responseData = [
				'state' => 'success',
				'message' => __(
					'validation.success_messages.masculine.delete',
					['modelName' => $this->modelName]
				)
			];
		}
		// Si no...
		else {
			$responseData = [
				'state' => 'error',
				// Devuelve los errores de validación..
				'errors' => [
					__(
						'validation.exists',
						['attribute' => $this->modelName]
					)
				],
			];
		}

		return response()->json($responseData);
	}



	/**
	 * Valida que el request tenga información
	 * válida.
	 * 
	 * @return array
	 */
	protected function validateRequest()
	{
		// Reglas de validación.
		if (request()->isMethod('post')) {
			$rules = [
				'name' => 'required',
				'password' => 'required',
			];
		} else {
			$rules = [];
		}

		// Validador del request.
		$validator = Validator::make(request()->all(), $rules);
		// Estado de la validación.
		$state = $validator->fails() ? 'error' : 'success';
		// Mensajes de error.
		$errors = $validator->errors()->all();

		return [
			'state' => $state,
			'errors' => $errors,
		];
	}
}
