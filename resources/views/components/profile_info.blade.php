    <div>
        @if(!empty($user->profile->first_name))
            <p class="text-info">First name:</p>
            <p class="h4 text-secondary"> {{ $user->profile->first_name }} </p>
            <hr>
        @endif
        @if(!empty($user->profile->last_name))
            <p class="text-info">Last name:</p>
            <p class="h4 text-secondary"> {{ $user->profile->last_name }} </p>
            <hr>
        @endif

        @if(!empty($user->profile->dob))
            <p class="text-info">Date of birth:</p>
            <p class="h4 text-secondary"> {{ $user->profile->dob }} </p>
            <hr>
        @endif

        @if(!empty($user->profile->gender))
            <p class="text-info">Gender:</p>
            <p class="h4 text-secondary"> {{ $user->profile->gender }} </p>
            <hr>
        @endif

        @if(!empty($user->profile->bio))
            <p class="text-info">Biography:</p>
            <p class="h4 text-secondary"> {{ $user->profile->bio }} </p>
            <hr>
        @endif

        @if(empty($user->profile->first_name) &&
            empty($user->profile->last_name) &&
            empty($user->profile->dob) &&
            empty($user->profile->bio) &&
            empty($user->profile->gender))
            <p class="h3 text-secondary">Nothing to show!</p>
        @endif
    </div>