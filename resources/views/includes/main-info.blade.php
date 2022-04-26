<?php
$users = DB::table('users')->get();

$interns = DB::table('users')->where('is_intern', 1)->get();

$tasks = DB::table('tasks')->get();
?>
<div class="col-md-3">
    <div class="card card-home-top card-bikes-sold">
        <div class="card-header">{{ __('Bikes Sold') }}</div>
        <div class="card-body">
            <h1 class="card-h1" style="float: left;">{{ __('552') }}</h1>
            <i class='icon card-img'><x-eos-directions-bike /></i>
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="card card-home-top">
        <div class="card-header">{{ __('Total Tasks') }}</div>
        <div class="card-body">
            <h1 class="card-h1" style="float: left;">{{ count($tasks) }}</h1>
            <i class='icon card-img'><x-ri-task-line /></i>
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="card card-home-top">
        <div class="card-header">{{ __('Interns') }}</div>
        <div class="card-body">
            <h1 class="card-h1" style="float: left;">{{ count($interns) }}</h1>
            <i class='icon card-img'><x-heroicon-o-users /></i>
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="card card-home-top">
        <div class="card-header">{{ __('Employees') }}</div>
        <div class="card-body">
            <h1 class="card-h1" style="float: left;">{{ count($users) }}</h1>
            <i class='icon card-img'><x-heroicon-o-users /></i>
        </div>
    </div>
</div>