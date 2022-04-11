<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usersData = [];
        //solo los usuarios que tienen el perfil relleno, por lo tanto tienen la localidad puesta
        if (auth()->user() == null || auth()->user()->latitude == null) { //no está logeado o aun no ha elegido localidad
            $users = User::where('location_id', '!=', null)
                ->orderByRaw('IF(last_activity > NOW() - INTERVAL 2 MINUTE,0,1)') //primero online
                // esta forma me daba problemas ->orderByRaw('-avatar DESC') //primero con avatar y luego sin
                ->orderByRaw('IF(avatar IS NULL,1,0)') //primero con avatar y luego sin
                ->orderBy('created_at', 'asc')
                ->get(); //TRAE TODOS, ANTIGUAMENTE PAGINABA DE 10 EN 10, MIRAR ESTO.
            //->paginate(10);
        } else { // está logeado
            $lat = auth()->user()->latitude;
            $lng = auth()->user()->longitude;
            $distance = auth()->user()->search_distance;

            if ($distance == 0) { //no tiene límite de distancia, me traigo todos
                $users = User::selectRaw('*,ST_Distance_Sphere(
                        POINT(' . $lng . ', ' . $lat . '),
                        POINT(longitude, latitude)
                    )/1000 distance  ')
                    ->where('id', '!=', auth()->user()->id)
                    ->where('location_id', '!=', null)
                    ->orderByRaw('IF(last_activity > NOW() - INTERVAL 2 MINUTE,0,1)') //primero online
                    ->orderByRaw('IF(avatar IS NULL,1,0)') //primero con avatar y luego sin
                    ->orderBy('distance', 'asc')
                    ->orderBy('created_at', 'asc')
                    ->paginate(10);

            } else {
                $users = User::selectRaw('*,ST_Distance_Sphere(
                        POINT(' . $lng . ', ' . $lat . '),
                        POINT(longitude, latitude)
                    )/1000 distance  ')
                    //aquí es donde filtro por distancia. Mirar con tiempo a ver si se pude hacer sin tener que volver a hacer el cálculo
                    ->where(DB::raw("(ST_Distance_Sphere(POINT(".$lng.",".$lat."), POINT(longitude,latitude))/1000)"), '<', $distance)
                    ->where('id', '!=', auth()->user()->id)
                    ->where('location_id', '!=', null)
                    ->orderByRaw('IF(last_activity > NOW() - INTERVAL 2 MINUTE,0,1)') //primero online
                    ->orderByRaw('IF(avatar IS NULL,1,0)') //primero con avatar y luego sin
                    ->orderBy('distance', 'asc')
                    ->orderBy('created_at', 'asc')
                    ->paginate(10);
            }
        }
        $now = date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s") . ' - 100 second')+60*60);
        /* viejo amifind
        return view('home', [
            'users' => $users,
            'now' => $now
        ]);
        */
        return \response()->json(['users' => $users]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
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
        //
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
}
