@extends('layouts/master')

@section('title')
Overview
@stop

@section('content')
<h2>Overview</h2>

<div>
    <p>
        Everything was completed. Because I started the assignment very early on, I did not end up using Stapler. Instead I created a solution where I create a user's directory based on their email address, and upload their profile image there. I store the name of the image in the database so I can reconstruct the path to the image when it's needed. The Friends system is simple. There is a single Friends table where each row represents a one-way friendship. When the Friend button is pushed, two rows are created. This establishes a two-way friendship. Searching for users and listing a user's friends use the same view, but different controller method. Post privacy settings are implemented by assigning every post its own privacy attribute. The privacy of a post towards a user is calculated by the system using Eloquent to query the database. My entire assignment doesn't use one DB::select statement - it only uses Eloquent. Unlike last assignment there are no outstanding issues I can see in my system.
    </p>
</div>

<h3>Entity-Relationship Diagram</h3>
<div class="text-center">
<img src="{{ URL::asset('docs/images/one_db_er_diagram.png') }}" />
</div>
<br/>

<h3><a href="{{ URL::asset('docs/images/site_diagram1.png') }}">Site Diagram</a></h3>
<img src="{{ URL::asset('docs/images/site_diagram1.png') }}" width="100%" />

@stop