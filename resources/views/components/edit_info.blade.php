<div class="info-form">
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <label for="first_name" class="text-info label">First Name:</label>
        <input type="text" name="first_name" class="form-control mb-2"
               value="{{ $user->profile ? $user->profile->first_name : "" }}">

        <label for="last_name" class="text-info label">Last Name:</label>
        <input type="text" name="last_name" class="form-control mb-2"
               value="{{ $user->profile ? $user->profile->last_name : "" }}">

        <label for="dob" class="text-info label">Date of brith:</label>
        <input type="date" name="dob" class="form-control mb-2"
               value="{{ $user->profile ? $user->profile->dob : "" }}"
               min="1900-01-01" max="{{ date('Y-m-d') }}">

        <label for="gender" class="text-info label d-block">Gender:</label>
        <input type="radio" name="gender" value="female" class="form-check-inline ml-3"
               @if(!empty($user->profile->gender) && $user->profile->gender == 'female') checked @endif >
        <span class="text-secondary">Female</span>
        <input type="radio" name="gender" value="male" class="form-check-inline ml-3"
               @if(!empty($user->profile->gender) && $user->profile->gender == 'male') checked @endif >
        <span class="text-secondary">Male</span>
        <input type="radio" name="gender" value="other" class="form-check-inline ml-3"
               @if(!empty($user->profile->gender) && $user->profile->gender == 'other') checked @endif >
        <span class="text-secondary">Other</span>
        <input type="radio" name="gender" value="" class="form-check-inline ml-3"
               @if(empty($user->profile->gender)) checked @endif >
        <span class="text-secondary">None</span>

        <label for="bio" class="text-info label d-block mt-1">Biography:</label>
        <textarea name="bio" class="form-control mb-2">{{ $user->profile ? $user->profile->bio : "" }}</textarea>

        <label for="img" class="text-info label d-block mt-1">Upload image:</label>
        <input type="file" name="img" class="form-control-file text-secondary">

        <input type="submit" value="Update" class="btn btn-outline-secondary float-right">
    </form>
</div>