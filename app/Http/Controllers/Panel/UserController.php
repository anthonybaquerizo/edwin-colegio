<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\User\UpdateRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    /**
     * @param UpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request)
    {
        $objUser = Auth::user();
        $objUser->email = $request->input('txt_email');
        if (!empty($request->input('txt_password'))) {
            $objUser->email = bcrypt($request->input('txt_password'));
        }
        $objUser->save();
        $objUserInfo = $objUser->info;
        $objUserInfo->dni = $request->input('txt_dni');
        $objUserInfo->last_name = $request->input('txt_lastname');
        $objUserInfo->names = $request->input('txt_names');
        $objUserInfo->phone = $request->input('txt_phone');
        $objUserInfo->gender = $request->input('cbo_gender');
        $objUserInfo->save();
        return response()->json(['message' => 'Datos actualizados correctamente.']);
    }

    /**
     * @param Request $request
     */
    public function changePhoto(Request $request)
    {
        $file = $request->file('file');
        if ($file->getClientOriginalExtension() !== 'jpg' && $file->getClientOriginalExtension() !== 'png') {
            return response()->json(['message' => 'El formato de imagen es incorrecto.'], 500);
        }
        $path = $file->store('user');
        $objUserInfo = Auth::user()->info;
        // Remove file
        Storage::delete($objUserInfo->photo_path);
        $objUserInfo->photo_path = $path;
        $objUserInfo->save();
        return response()->json(['message' => 'Su imagen fue cambiada correctamente.']);
    }

    /**
     * Lista de cursos del usuario
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function courses()
    {
        $courses = (new User())->searchAlumnCourses(Auth::user()->id);
        return view('courses', compact(
            'courses'
        ));
    }

}
