@php

foreach($trials as $trial){
    if (time() - strtotime($trial->created_at) > 60*60*24) {
    
        $trial = App\Trials::find($trial->id);
        $trial->is_decline = 1;
        $trial->save();
    }
}
@endphp