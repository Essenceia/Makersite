<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class AfterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        //retrieve all executed queries
        $queries = DB::getQueryLog();

        //code to save query logs in a file

        //return response
        Log::debug("**************Querry Logs**********");
        $logData = '';
        for ($i=0;$i<count($queries);$i++) {
            $query =  $queries[$i]['query'].'';

            $time =  date('Y-m-d H:i:s', time());
            //loop through all bindings
            for($j=0; $j<sizeof($queries[$i]['bindings']); $j++)
            {
                $queries[$i]['bindings'][$j] = $queries[$i]['bindings'][$j] == '' ? "''" : $queries[$i]['bindings'][$j];
                //replace ? with actual value
                $query = str_replace_first($query,'?',$queries[$i]['bindings'][$j]);
            }

            //remove all new lines
            $query = trim(preg_replace( "/\r\n|\n/", "", $query));
            $newArr = array(date('Y-m-d H:i:s'), $query);
            $logData .= implode("\t",$newArr) . "\n";
        }

//write if any new data
        if($logData != ''){
          Log::debug($logData);
        }
        Log::debug("**************end Querry Logs**********");
        return $response;

    }
}