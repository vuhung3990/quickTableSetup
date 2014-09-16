// laravel
public function test() {
        $start = Input::get('start');
        $length = Input::get('length');
        $searchValue = Input::get('search')['value'];
        $orderColumn = Input::get('order')[0]['column'];
        $orderType = Input::get('order')[0]['dir'];
        $draw = Input::get('draw');
        
        $columns = array(
                    'id',
                    'src',
                    'author',
                    'title',
                    'decription',
                    'thumb',
                    'duration',
                    'rate_count',
                    'type',
                    'upload_time',
                    'added_time'
                );
        $queryTotal = DB::table('dancemovie')
                    ->select($columns)
                    ->where('activated', '=', 1);
        // NOTEEEE : TOTAL
        $total = $queryTotal->count() - $length; // total when start query
        
        $query = $queryTotal
                    ->orderBy($columns[$orderColumn], $orderType)
                    ->offset($start)
                    ->limit($length);
        
		// var_dump(DB::getQueryLog());
        $filtered = $total;
        if($searchValue != NULL){
            $query = $query->Where('id', 'LIKE', '%'.$searchValue.'%')
                        ->orWhere('author', 'LIKE', '%'.$searchValue.'%')
                        ->orWhere('title', 'LIKE', '%'.$searchValue.'%')
                        ->orWhere('decription', 'LIKE', '%'.$searchValue.'%')
                        ->orWhere('title_en', 'LIKE', '%'.$searchValue.'%')
                        ->orWhere('decription_en', 'LIKE', '%'.$searchValue.'%');
						
			// NOTEEEE : FILTERED
            $filtered = $query->count();
        }
        
        $data = array();
        foreach ($query->get() as $item) {
            $temp = array();
            foreach ($columns as $column) {
                
                if($column === $columns[5]){
                    $temp[] = '<img width="70" height="50" src="'.$item[$column].'" />';
                } else if ($column === $columns[1]){
                    $url = ($item[$column] == 0) ? Config::get('myconfig.icon_youtube') : Config::get('myconfig.icon_nico');
                    $temp[] = '<img width="50" height="50" src="'.$url.'" />';
                }else if($column === $columns[8]){
                    $url = ($item[$column] == 0) ? Config::get('myconfig.icon_dance') : Config::get('myconfig.icon_song');
                    $temp[] = '<img width="40" height="40" src="'.$url.'" />';
                }else{
                    $temp[] = $item[$column];
                }
            }
            $data[] = $temp;
        }
        
        $result = new stdClass();
        $result->draw = $draw;
        $result->recordsTotal = $total;
        $result->recordsFiltered = $filtered;
        $result->data = $data;
        
        return Response::json($result);
    }