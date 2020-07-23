<div class="ui middle aligned center aligned grid">
    <div class="login column">
        <h2 class="ui image header">
            <!-- <img src="assets/images/logo.png" class="image"> -->
            <div class="content">
                Log-in to your account
            </div>
        </h2>
        <form class="ui large form" method="post" action="">
            <div class="ui stacked segment">
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="text" name="email" placeholder="E-mail address">
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input type="password" name="password" placeholder="Password">
                    </div>
                </div>
                <button type="submit" class="ui fluid large blue submit button">Login</button>
            </div>

            <div class="ui error message <?php echo (isset($message))? 'visible': '' ?>">
                <?php echo $message ?>
            </div>

        </form>

        <div class="ui message">
            First time customer? <a href="register">Register</a>
        </div>
    </div>
</div>

<script>
    $('.ui.form')
        .form({
            fields: {
                email: 'empty',
                password: ['empty'],
            }
        });
</script>