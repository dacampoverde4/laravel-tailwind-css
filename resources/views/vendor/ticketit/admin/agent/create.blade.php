@extends('ticketit::layouts.master')
@section('page', trans('ticketit::admin.agent-create-title'))
 
@section('ticketit_content')
    @if ($users->isEmpty())
        <h3 class="text-center">{{ trans('ticketit::admin.agent-create-no-users') }}</h3>
    @else
        {!! CollectiveForm::open(['route'=> $setting->grab('admin_route').'.agent.store', 'method' => 'POST', 'class' => '']) !!}
        <p>{{ trans('ticketit::admin.agent-create-select-user') }}</p>

        <select id="agents_list" name="agents[]" class="form-control" multiple>
             @foreach($users as $user)
                <option value="{{ $user->id }}" {!! $user->ticketit_agent ? "selected" : "" !!}>{{ $user->name }}</option>
             @endforeach
        </select>
        <table class="table table-hover">
            <tbody>
            @foreach($users as $user)
            
                <tr>
                    <td>
                        <div class="form-check form-check-inline">
                           <input id="agent_{{$loop->index}}" name="agents[]" type="checkbox" class="form-check-input" value="{{ $user->id }}" {!! $user->ticketit_agent ? "checked" : "" !!}> 
                           
                                <label for="agent_{{$loop->index}}" class="form-check-label">{{ $user->name }}</label>
                            
                        </div>
                    </td>
                </tr>
                
            @endforeach
            </tbody>
        </table>
        {!! link_to_route($setting->grab('admin_route').'.agent.index', trans('ticketit::admin.btn-back'), null, ['class' => 'btn btn-link']) !!}
        {!! CollectiveForm::submit(trans('ticketit::admin.btn-submit'), ['class' => 'btn btn-primary']) !!}
        {!! CollectiveForm::close() !!}
    @endif

    {!! $users->render("pagination::bootstrap-4") !!}
@stop
