<?php
// Remove the inline styles and use the existing CSS classes from index.css
?>

<div class="pay-body">
    <div class="pay">
        <h2>Payment Method</h2>
        <div class="payment-info">
            <h3>Esewa number: +977 9841902307</h3>
            <h3>Esewa Name: Niraj Shrestha</h3>
            <?php
            $sql = mysqli_query($conn, "SELECT * FROM product WHERE pid = $id");
            $check = mysqli_query($conn, "SELECT * FROM sale WHERE pid = $id");
            $pro = mysqli_fetch_assoc($sql);
            $sale = mysqli_fetch_assoc($check);
            ?>
            <h4>Price: Rs. <?php echo mysqli_num_rows($check) == 0 ? $pro['price'] : $sale['sale_amt']; ?></h4>
        </div>

        <form action="buyForm.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
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
                <input type="number" name="ward" min="1" required>
            </div>

            <div class="form-group">
                <label for="ph">Phone Number</label>
                <input type="number" name="ph" maxlength="10" required>
                <small>Format: 98XXXXXXXX</small>
            </div>

            <div class="form-group">
                <label for="image">Payment Receipt</label>
                <input type="file" name="image" accept="image/*" required>
                <small>Accepted formats: JPG, JPEG, PNG</small>
            </div>

            <input type="submit" name="pay" value="Confirm Payment">
        </form>
    </div>
</div>
        