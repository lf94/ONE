<div class="form-group">
    <label for="email">Email: {{{ $errors->first('email') }}}</label>
    {{ Form::text('email', $user->email, array('class'=>'form-control', 'placeholder'=>'name@example.com')) }}
</div>
<div class="form-group">
    <label for="password">Password: {{{ $errors->first('password') }}}</label>
    {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}
</div>
<div class="form-group">
    <label for="name">Full name: {{{ $errors->first('fullname') }}}</label>
    {{ Form::text('fullname', $user->fullname, array('class'=>'form-control', 'placeholder'=>"Enter your account's name here")) }}
</div>
<div class="form-group">
    <label for="birthday">Birthday: {{{ $errors->first('birthday') }}}</label>
    {{ Form::text('birthday', $user->birthday, array('class'=>'form-control', 'placeholder'=>"Day-Month-Year")) }}
</div>
<div class="form-group">
    <label for="profile-picture">Profile picture: </label>
    {{ Form::file('profile-picture', array('class'=>'form-control')) }}
</div>