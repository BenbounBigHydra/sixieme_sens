<?php
$user = App\Models\User::where('email', 'admin@hug.ch')->first();
if ($user) {
    $user->password = bcrypt('password');
    $user->save();
    echo "Password reset for admin@hug.ch\n";
} else {
    echo "User not found\n";
}
