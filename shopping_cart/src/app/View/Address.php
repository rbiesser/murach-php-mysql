<?php if (isset($message)) : ?>
    <div class="ui message">
        <p><?php echo $message ?></p>
    </div>
<?php endif ?>

<h1>Add an Address</h1>
<div id="edit_account_form">
    <form class="ui big form" method="post">

        <div class="field">
            <!-- <label>Primary Shipping Address</label> -->
            <div class="fields">
                <div class="twelve wide field">
                    <label>Street Address</label>
                    <input type="text" name="line1" placeholder="Street Address">
                </div>
                <div class="four wide field">
                    <label>Apt./Unit #</label>
                    <input type="text" name="line2" placeholder="Apt./Unit #">
                </div>
            </div>
        </div>
        <div class="three fields">
            <div class="field">
                <label>City</label>
                <input type="text" name="city" placeholder="City">
            </div>
            <div class="field">
                <label>State</label>
                <select class="ui search selection dropdown" name="state" id="search-select">
                    <option value="">State</option>
                    <option value="AL">Alabama</option>
                    <option value="AK">Alaska</option>
                    <option value="AZ">Arizona</option>
                    <option value="AR">Arkansas</option>
                    <option value="CA">California</option>
                    <option value="CO">Colorado</option>
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="DC">District Of Columbia</option>
                    <option value="FL">Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="HI">Hawaii</option>
                    <option value="ID">Idaho</option>
                    <option value="IL">Illinois</option>
                    <option value="IN">Indiana</option>
                    <option value="IA">Iowa</option>
                    <option value="KS">Kansas</option>
                    <option value="KY">Kentucky</option>
                    <option value="LA">Louisiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="MN">Minnesota</option>
                    <option value="MS">Mississippi</option>
                    <option value="MO">Missouri</option>
                    <option value="MT">Montana</option>
                    <option value="NE">Nebraska</option>
                    <option value="NV">Nevada</option>
                    <option value="NH">New Hampshire</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NM">New Mexico</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="ND">North Dakota</option>
                    <option value="OH">Ohio</option>
                    <option value="OK">Oklahoma</option>
                    <option value="OR">Oregon</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="SD">South Dakota</option>
                    <option value="TN">Tennessee</option>
                    <option value="TX">Texas</option>
                    <option value="UT">Utah</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WA">Washington</option>
                    <option value="WV">West Virginia</option>
                    <option value="WI">Wisconsin</option>
                    <option value="WY">Wyoming</option>
                </select>
            </div>
            <div class="field">
                <label>Zip Code</label>
                <input type="text" name="zipCode" placeholder="Zip Code">
            </div>

        </div>

        <input type="hidden" name="addressID" value=""/>
        <button type="submit" class="ui big blue button" tabindex="0">Save Address</button>
        <a href="/account" class="ui button" tabindex="0">Cancel</a>
        <div class="ui error message"></div>
    </form>
</div>

<script>
    $('.search.dropdown')
        .dropdown();

    $('.ui.form')
        .form({
            fields: {
                line1: 'empty',
                line2: 'empty',
                city: 'empty',
                state: ['empty'],
                zipCode: ['empty']
            }
        });
</script>