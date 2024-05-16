@extends('layouts.master')

@section('title', 'About')
@section('content')
<div class="container mb-5">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <h1 style="margin: 4%">
        <img src=images/logo.png alt="SquadFinder logo" width="80" height="80"> 
        About SquadFinder</h1>
    <p>SquadFinder is a website that allows you to find other players to play with.</p>
    <p>It is a project for the Web Development subject of the Computer Engineering degree 
        at the University of Alicante.</p>
    <p>As a new website, we are still working on improving it, so if you have any suggestions, 
        please contact us, with any of the following ways:</p>
        <br>
        <ul class="list-group">
            <li class="list-group-item">By email: <a class="link-offset-2 link-underline link-underline-opacity-0" href="mailto:squadfinder@help.es">
                squadfinder@help.es</a></li>
            <li class="list-group-item">By Twitter: <a class="link-offset-2 link-underline link-underline-opacity-0" href="https://twitter.com/SquadFinder">
                SquadFinder</a></li>
            <li class="list-group-item">By Facebook: <a class="link-offset-2 link-underline link-underline-opacity-0" href="https://www.facebook.com/SquadFinder">
                SquadFinder</a></li>
            <li class="list-group-item">By Instagram: <a class="link-offset-2 link-underline link-underline-opacity-0" href="https://www.instagram.com/squadfinder/">
                SquadFinder</a></li>
            <li class="list-group-item">By Discord: <a class="link-offset-2 link-underline link-underline-opacity-0" href="https://discord.gg/8Z4Z7Z">
                SquadFinder</a></li>
            <li class="list-group-item">By leaving a comment in the gap:
                <br>
                <input type="text" name="comment" id="comment" placeholder="Leave a comment" size="50">
                <button type="submit">Send</button>
            </li>
        </ul>
</div>
@endsection