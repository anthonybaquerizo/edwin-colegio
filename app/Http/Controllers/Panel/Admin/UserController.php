<?php

namespace App\Http\Controllers\Panel\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Admin\User\CreateRequest;
use App\Http\Requests\Panel\Admin\User\UpdateRequest;
use App\User;
use App\UserInfo;
use App\UserType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * @param $type
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index(Request $request, $type)
    {
        $objUserType = (new UserType())->find($type);
        if (empty($objUserType)) {
            return redirect()->route('home');
        }
        $result = (new User())->search(
            $type,
            $request->input('txt_name'),
            $request->input('txt_username')
        );
        return view('admin.user.index', [
            'objUserType' => $objUserType,
            'result' => $result,
        ]);
    }

    /**
     * @param $type
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create($type)
    {
        $objUserType = (new UserType())->find($type);
        if (empty($objUserType)) {
            return redirect()->route('home');
        }
        return view('admin.user.create', [
            'objUserType' => $objUserType,
        ]);
    }

    /**
     * @param $type
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        $objUser = User::find($id);
        if (empty($objUser)) {
            return redirect()->route('admin.user.index');
        }
        $objUserType = (new UserType())->find($objUser->user_type_id);
        $objUserInfo = $objUser->info;
        return view('admin.user.edit', [
            'objUserType' => $objUserType,
            'objUser' => $objUser,
            'objUserInfo' => $objUserInfo,
        ]);
    }

    /**
     * @param CreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateRequest $request)
    {
        $objUserType = UserType::find($request->input('txt_type'));
        if (empty($objUserType)) {
            return response()->json(['message' => 'El tipo de usuario es invalido.'], 500);
        }
        $file = $request->file('file');
        $path = null;
        if (!empty($file)) {
            if ($file->getClientOriginalExtension() !== 'jpg' && $file->getClientOriginalExtension() !== 'png') {
                return response()->json(['message' => 'El formato de imagen es incorrecto.'], 500);
            }
            $path = $file->store('user');
        }

        $username = substr($request->input('txt_names'), 0, 1)
            . explode(' ', $request->input('txt_lastname'))[0]
            . substr(explode(' ', $request->input('txt_lastname'))[1], 0, 1);

        $objUser = new User();
        $objUser->fill([
           'username' => strtolower($username),
           'email' => strtolower($request->input('txt_email')),
           'password' => bcrypt($request->input('txt_dni')),
           'status' => 1,
        ]);
        $objUser->type()->associate($objUserType);
        $objUser->save();
        $objUserInfo = new UserInfo();
        $objUserInfo->fill([
            'dni' => $request->input('txt_dni'),
            'names' => ucwords(strtolower($request->input('txt_names'))),
            'last_name' => ucwords(strtolower($request->input('txt_lastname'))),
            'phone' => $request->input('txt_phone'),
            'photo_path' => $path,
            'gender' => $request->input('cbo_gender'),
            'status' => 1,
        ]);
        $objUser->info()->save($objUserInfo);
        return response()->json(['message' => 'Usuario creado correctamente.']);
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        /** @var User $objUser */
        $objUser = User::find($id);
        if (empty($objUser)) {
            return response()->json(['message' => 'El usuario no pudo ser encontrado.'], 500);
        }
        $objUserType = $objUser->type;
        $file = $request->file('file');
        $path = null;
        if (!empty($file)) {
            if ($file->getClientOriginalExtension() !== 'jpg' && $file->getClientOriginalExtension() !== 'png') {
                return response()->json(['message' => 'El formato de imagen es incorrecto.'], 500);
            }
            $path = $file->store('user');
        }
        $objUser->fill([
            'username' => $request->input('txt_username'),
            'email' => $request->input('txt_email'),
            'status' => 1,
        ]);
        if (!empty($request->input('txt_password'))) {
            $objUser->setAttribute('password', bcrypt($request->input('txt_password')));
        }
        $objUser->type()->associate($objUserType);
        $objUser->save();
        $objUserInfo = new UserInfo();
        $objUserInfo->update([
            'dni' => $request->input('txt_dni'),
            'names' => $request->input('txt_names'),
            'last_name' => $request->input('txt_lastname'),
            'phone' => $request->input('txt_phone'),
            'photo_path' => $path,
            'gender' => $request->input('cbo_gender'),
            'status' => 1,
        ]);
        return response()->json(['message' => 'Usuario actualizado correctamente.']);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request, $id)
    {
        /** @var User $objUser */
        $objUser = User::find($id);
        if (empty($objUser)) {
            return response()->json(['message' => 'El usuario no pudo ser encontrado.'], 500);
        }
        $objUser->delete();
        return response()->json(['refresh' => route('admin.user.index', ['type' => $objUser->user_type_id])]);
    }

}
