 <?php if (auth()->user()->role_id == 1 || auth()->user()->role_id == 3){?>
            @include('layouts/admin')
            <?php  }else{?>

            @include('layouts/user')
            <?php }?>
