<h2>Google Account Details</h2>
<div class="ac-data">
    <!-- 
    Mostrar información de perfil de Google
    Si el usuario inició sesión con su cuenta de Google, los detalles del perfil se muestran con un enlace de cierre de sesión.
    -->
    <img src="<?php echo $userData['picture']; ?>"/>
    <p><b>Google ID:</b> <?php echo $userData['oauth_uid']; ?></p>
    <p><b>Name:</b> <?php echo $userData['first_name'].' '.$userData['last_name']; ?></p>
    <p><b>Email:</b> <?php echo $userData['email']; ?></p>
    <p><b>Gender:</b> <?php echo $userData['gender']; ?></p>
    <p><b>Locale:</b> <?php echo $userData['locale']; ?></p>
    <p><b>Logged in with:</b> Google</p>
    <p><a href="<?php echo $userData['link']; ?>" target="_blank">Click to visit Google+</a></p>
    <p>Logout from <a href="<?php echo base_url().'user_authentication/logout'; ?>">Google</a></p>
</div>

<!--

<h1>Userdata</h1>
<?php var_dump($profileData); ?>
<p>
    ID:  <?php echo $profileData['id']; ?>
</p>
<p>
    Email:  <?php echo $profileData['email']; ?>
</p>
<p>
    Verified Email:  <?php   echo $profileData['verified_email']; ?>
</p>
<p>
    Name:  <?php echo $profileData['name']; ?>
</p>
<p>
    Profile Picture:  <img src="<?php echo $profileData['picture']; ?>" style="width:50px; hight:50px;" />
</p>
<p>
    <a href="<?php site_url('LoginWithGooglePlus/logout')?>">Logout</a>
</p>

-->