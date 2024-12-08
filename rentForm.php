<?php
// Remove the inline styles and use the existing CSS classes from index.css
$id = $_GET['id'];
$sql = mysqli_query($conn, "SELECT * FROM rent WHERE rid = '$id'");
$result = mysqli_fetch_assoc($sql);
$price = $result['price'];
?>

<div class="pay-body">
    <div class="pay">
        <h2>Payment Method</h2>
        <div class="payment-info">
            <h3>Esewa number: +977 9841902307</h3>
            <h3>Esewa Name: Niraj Shrestha</h3>
            <h4>Price per hour: Rs. <?php echo $price; ?></h4>
        </div>

        <form action="rform.php?id=<?php echo $id; ?>&price=<?php echo $price; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="hour">Hours</label>
                <input type="number" name="hour" id="hour" value="1" min="1" max="24" onkeydown='checkHours()'>
                <small>Each set can only be rented for 24 hours max</small>
            </div>

            <div class="form-group">
                <label>Total Price: Rs. <b id="price"><?php echo $price; ?></b></label>
            </div>

            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="date" required>
                <small>Renting must be a day after the payment has been done</small>
            </div>

            <div class="form-group">
                <label for="time">Time</label>
                <input type="time" name="time" min="07:00" max="18:00" required>
                <small>Rental time is from 7am to 9pm</small>
            </div>

            <div class="form-group">
                <label for="district">District</label>
                <select name="district" required>
                    <option value="" selected disabled>--Select District--</option>
                    <?php
                    $districts = array("Achham", "Arghakhanchi", "Baglung", "Baitadi", "Bajhang", "Bajura", "Banke", 
                        "Bara", "Bardiya", "Bhaktapur", "Bhojpur", "Chitwan", "Dadeldhura", "Dailekh", "Dang", 
                        "Darchula", "Dhading", "Dhankuta", "Dhanusha", "Dolakha", "Dolpa", "Doti", "Gorkha", 
                        "Gulmi", "Humla", "Ilam", "Jajarkot", "Jhapa", "Jumla", "Kailali", "Kalikot", "Kanchanpur", 
                        "Kapilbastu", "Kaski", "Kathmandu", "Kavre", "Khotang", "Lalitpur", "Lamjung", "Mahottari", 
                        "Makwanpur", "Manang", "Morang", "Mugu", "Mustang", "Myagdi", "Nawalparasi", "Nuwakot", 
                        "Okhaldhunga", "Palpa", "Panchthar", "Parbat", "Parsa", "Pyuthan", "Ramechap", "Rasuwa", 
                        "Rautahat", "Rolpa", "Rukum", "Rupandehi", "Salyan", "Sankhuwasabha", "Saptari", "Sarlahi", 
                        "Sindhuli", "Sindhupalchowk", "Siraha", "Solukhumbu", "Sunsari", "Surkhet", "Syangja", 
                        "Tanahu", "Taplejung", "Terhathum", "Udayapur");
                    
                    foreach($districts as $district) {
                        echo "<option value=\"$district\">$district</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="municipality">Municipality</label>
                <input type="text" name="municipality" required>
            </div>

            <div class="form-group">
                <label for="tole">Village/Tole</label>
                <input type="text" name="tole" required>
            </div>

            <div class="form-group">
                <label for="ward">Ward No.</label>
                <input type="number" name="ward" pattern="{1,2}" required>
            </div>

            <div class="form-group">
                <label for="ph">Phone Number</label>
                <input type="number" name="ph" required>
                <small>Format: 98XXXXXXXX</small>
            </div>

            <div class="form-group">
                <label for="image">Payment Receipt</label>
                <input type="file" name="image" accept="image/*" required>
                <small>Accepted formats: JPG, JPEG, PNG</small>
            </div>

            <input type="submit" name="pay" value="Confirm Rental">
        </form>
    </div>
</div>

<script>
const basePrice = <?php echo $price; ?>;
document.getElementById('price').innerHTML = basePrice;

function checkHours() {
    let hours = document.getElementById('hour').value;
    document.getElementById('price').innerHTML = basePrice * hours;
}
</script>