@extends('layouts/master')

@section('title')
Overview
@stop

@section('content')
<h2>Overview</h2>

<div>
<p>
    Laravel is an amazing framework. Usually at the mercy of PHP and creating action-script based websites, using Laravel was so efficient and a pleasure to use I was able to complete the requirements and more. ONE uses Laravel’s facilities extensively - Blade for creating views, controllers to handle logic, models to hold data, and I’ve decided to create a similar clone of Eloquent since we were not allowed to use it, called Leeloquent, to separate and generalize my database transactions.
</p>
<p>
ONE supports a rudimentary user system. Users may register, login or logout. Users may post content or comment on posts. These actions can be reviewed on their profile pages. The time of posts or comments are recorded. Posts may be modified or deleted. Comments can be deleted. A user can personalize their account by linking to a picture that will appear around the entire site.
</p>

<p>
ONE supports an authorization system using filters. Every REST action is checked to ensure the user has permission to execute said action.
</p>

<p>
I hope to have a friending feature implemented by the due date of Assignment 2.
</p>
</div>

<h3>Entity-Relationship Diagram</h3>
<div class="text-center">
<img src="{{ URL::asset('docs/images/one_db_er.png') }}" />
</div>
<br/>

<h3><a href="{{ URL::asset('docs/images/site_diagram1.png') }}">Site Diagram</a></h3>
<img src="{{ URL::asset('docs/images/site_diagram1.png') }}" width="100%" />

@stop