<?php

namespace App\Http\Controllers;
use Exception;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $validator = $this->validateData($request);

            if ($validator->fails()){
                return response()->json($validator->errors(), Response::HTTP_UNAUTHORIZED);
            }

            $profile = new Profile();

            $this->dataSave($profile, $request, 'save');

            return response()->json(['message' => 'Perfil guardado correctamente'], Response::HTTP_OK);

        }catch (Exception $e){
            return response()->json(['message' => 'Error al guardar el perfil'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $profile = Profile::where('id_user', $id)->first();

            return response()->json(['profile' => $profile], Response::HTTP_OK);

        }catch (Exception $e){
            return response()->json(['message' => 'Error al cargar le perfil'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $profile = Profile::where('id_user', $id)->first();

            if ($profile){

                $validator = $this->validateData($request);

                if ($validator->fails()){
                    return response()->json($validator->errors(), Response::HTTP_UNAUTHORIZED);
                }

                $this->dataSave($profile, $request, 'update');

                return response()->json(['message' => 'Anuncio editado correctamente'], Response::HTTP_OK);

            }else{
                $this->store($request);
            }

        }catch (Exception $e){

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function validateData($request){

        $validator = Validator::make($request->all(),[
            'description' => 'string|min:10|max:500',
            //'location_id' => 'int',
            'birth_date' => 'date',
            'gender' => 'string',
            'marital_status' => 'string',
            //'searching' => 'string',
            'search_age_from' => 'int',
            'search_age_to' => 'int',
            //'search_distance' => 'int'
        ]);

        return $validator;
    }

    private function dataSave($profile, $request, $action){
        $profile->id_user = $request->input('idUser') ? (int) $request->input('idUser') : $request->input('id_user');
        $profile->description = $request->input('description');
        $profile->birth_date = $request->input('birth_date');
        $profile->gender = $request->input('gender');
        $profile->marital_status = $request->input('marital_status');
        $profile->searching = 'search';
        $profile->search_age_from = 0;
        $profile->search_age_to = 9;

        $profile->$action();
    }
}
