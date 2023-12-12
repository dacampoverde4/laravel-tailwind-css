@extends('admin.layout.master')
@section('content')
<div class="row">
<div id="app" style="width:100%;">
    <div class="container-fluid appposi">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="acard-body ">
                        @if ( isthisSubscribed() || getmanualfeatures('token_monthly_connection_'))
                        <div class="mtop30">
                            <chat-users v-on:fetchusers="fetchMessages" :chatnewusers="chatnewusers" :chatusers="chatusers" :chatstaffadmins="chatstaffadmins"></chat-users>
                            <chat-messages v-on:messagesent="addMessage" v-on:fetchusers="fetchMessages" :user="{{ Auth::user() }}" :messages="messages"></chat-messages>
                        </div>
                        @else
                        @include('includes.debitTokens', ['featurevalue'=>'token_monthly_connection_value_','featureclass'=>'chat','featurename'=>'token_monthly_connection_', 'featureMessage'=>'Hey '. ucfirst( Auth::user()->name ) .'!. Upgrade your membership today to experience unlimited chat.'])
                        @endif
                    </div>
                    <!-- ============================================================== -->
                    <!-- End PAge Content -->
                    <!-- ============================================================== -->

                    <!-- Right sidebar -->
                    <!-- ============================================================== -->
                    <!-- .right-sidebar -->
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
