
@php
$featureclass = isset($featureclass)? $featureclass: 5;
@endphp
<div class="row upgrade">
    <div class="col-md-9 col-sm-9">
        <div class="upgdinfo bggray font300">
            <p>{{ $featureMessage }}</p>
        </div>
     </div>
    <div class="col-md-3 col-sm-3">                         
        <button style="padding: 18px 22px;" type="submit" class="buytokens_btn pull-right" data-toggle="modal" data-target="#myModalbuy">Buy Tokens</button> 
        <button style="padding: 18px 33px;" type="submit" class="upgrade_btn pull-right" data-toggle="modal" data-target="#myModalbuy">Upgrade</button> 
    </div>
     <div class="modal fade {{ $featureclass }}" id="myModalbuy" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h3 class="modal-title inline_block font28">UPGRADE TODAY!</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut</p>
                    <form method="post" action="{{ route('debit.tokens') }}">
                        @csrf
                        <input type="hidden" name="feturename" value="{{ $featurename }}"/>
                        <input type="hidden" name="featurevalue" value="{{ $featurevalue }}"/>
                        <div class="">
                        <a href="{{ route('buy-tokens') }}" class="buytokens_btn pull-right">Buy Tokens</a> 
                        <button type="submit" class="upgrade_btn pull-left" data-toggle="modal" data-target="#myModalbuy">Upgrade</button> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
