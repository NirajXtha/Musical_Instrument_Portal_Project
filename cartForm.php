<style>
            .pay-body{
                background-image: url(images/gt.jpg);
                background-size: cover;
                background-repeat: no-repeat;
                color: white;
                display: flex;
                justify-content: center;
                padding: 20px;
                font-weight: 700;
            }
            .pay{
                border: 4px double;
                padding: 25px;
                border-radius: 50px 0px 50px 0px; 
                max-width: 350px;
                backdrop-filter: blur(10px);
            }
            .pay h2{
                text-align: center;
            }
            .pay form input, .pay form select{
                width: 100%;
                height: 1.5rem;
                
            }
        </style>
        <div class="pay-body">
            <div class="pay">
                <h2>Payment Method</h2>
                <label for="Esewa"><h3>Esewa number: +977 9841902307</h3></label>
                <label for="Esewa"><h3>Esewa Name: Niraj Shrestha</h3></label>
                <?php 
                $sql = mysqli_query($conn,"SELECT DISTINCT * FROM cart WHERE username = '$user' AND status = 'pending'");
                $price = 0;
                while($p = mysqli_fetch_assoc($sql)){
                    $price = $price + $p['price'];
                }
                $id = $_GET['id']; 
                ?>
                <h4>Total: Rs. <?=$price?></h4>
                <form action="cartPay.php?id=<?=$id?>" method="post" enctype="multipart/form-data">
                    <label for="District">District</label>
                    <select name="district" class="" required>
                        <option value="" selected disabled>--Select District--</option>
                            <option value="Achham"  >Achham</option>
                            <option value="Arghakhanchi"  >Arghakhanchi</option>
                            <option value="Baglung"  >Baglung</option>
                            <option value="Baitadi"  >Baitadi</option>
                            <option value="Bajhang"  >Bajhang</option>
                            <option value="Bajura"  >Bajura</option>
                            <option value="Banke"  >Banke</option>
                            <option value="Bara"  >Bara</option>
                            <option value="Bardiya"  >Bardiya</option>
                            <option value="Bhaktapur"  >Bhaktapur</option>
                            <option value="Bhojpur"  >Bhojpur</option>
                            <option value="Chitwan"  >Chitwan</option>
                            <option value="Dadeldhura"  >Dadeldhura</option>
                            <option value="Dailekh"  >Dailekh</option>
                            <option value="Dang"  >Dang</option>
                            <option value="Darchula"  >Darchula</option>
                            <option value="Dhading"  >Dhading</option>
                            <option value="Dhankuta"  >Dhankuta</option>
                            <option value="Dhanusha"  >Dhanusha</option>
                            <option value="Dolakha"  >Dolakha</option>
                            <option value="Dolpa"  >Dolpa</option>
                            <option value="Doti"  >Doti</option>
                            <option value="Gorkha"  >Gorkha</option>
                            <option value="Gulmi"  >Gulmi</option>
                            <option value="Humla"  >Humla</option>
                            <option value="Ilam"  >Ilam</option>
                            <option value="Jajarkot"  >Jajarkot</option>
                            <option value="Jhapa"  >Jhapa</option>
                            <option value="Jumla"  >Jumla</option>
                            <option value="Kailali"  >Kailali</option>
                            <option value="Kalikot"  >Kalikot</option>
                            <option value="Kanchanpur"  >Kanchanpur</option>
                            <option value="Kapilbastu"  >Kapilbastu</option>
                            <option value="Kaski"  >Kaski</option>
                            <option value="Kathmandu"  >Kathmandu</option>
                            <option value="Kavre"  >Kavre</option>
                            <option value="Khotang"  >Khotang</option>
                            <option value="Lalitpur"  >Lalitpur</option>
                            <option value="Lamjung"  >Lamjung</option>
                            <option value="Mahottari"  >Mahottari</option>
                            <option value="Makwanpur"  >Makwanpur</option>
                            <option value="Manang"  >Manang</option>
                            <option value="Morang"  >Morang</option>
                            <option value="Mugu"  >Mugu</option>
                            <option value="Mustang"  >Mustang</option>
                            <option value="Myagdi"  >Myagdi</option>
                            <option value="Nawalparasi"  >Nawalparasi</option>
                            <option value="Nuwakot"  >Nuwakot</option>
                            <option value="Okhaldhunga"  >Okhaldhunga</option>
                            <option value="Palpa"  >Palpa</option>
                            <option value="Panchthar"  >Panchthar</option>
                            <option value="Parbat"  >Parbat</option>
                            <option value="Parsa"  >Parsa</option>
                            <option value="Pyuthan"  >Pyuthan</option>
                            <option value="Ramechap"  >Ramechap</option>
                            <option value="Rasuwa"  >Rasuwa</option>
                            <option value="Rautahat"  >Rautahat</option>
                            <option value="Rolpa"  >Rolpa</option>
                            <option value="Rukum"  >Rukum</option>
                            <option value="Rupandehi"  >Rupandehi</option>
                            <option value="Salyan"  >Salyan</option>
                            <option value="Sankhuwasabha"  >Sankhuwasabha</option>
                            <option value="Saptari"  >Saptari</option>
                            <option value="Sarlahi"  >Sarlahi</option>
                            <option value="Sindhuli"  >Sindhuli</option>
                            <option value="Sindhupalchowk"  >Sindhupalchowk</option>
                            <option value="Siraha"  >Siraha</option>
                            <option value="Solukhumbu"  >Solukhumbu</option>
                            <option value="Sunsari"  >Sunsari</option>
                            <option value="Surkhet"  >Surkhet</option>
                            <option value="Syangja"  >Syangja</option>
                            <option value="Tanahu"  >Tanahu</option>
                            <option value="Taplejung"  >Taplejung</option>
                            <option value="Terhathum"  >Terhathum</option>
                            <option value="Udayapur"  >Udayapur</option>
                    </select><br><br>
                    <label for="municipality">Municipality</label>
                    <input type="text" name="municipality" id="" required><br><br>
                    <label for="tole">Village/Tole</label>
                    <input type="text" name="tole" id="" required><br><br>
                    <label for="ward">Ward No.</label>
                    <input type="number" name="ward" id="" required><br><br>
                    <label for="number">Phone Number:</label>
                    <input type="number" name="ph" required><br><br>
                    <label for="payment">Payment Receipt:</label>
                    <input type="file" name="image" id="" required><br><br>
                    <input type="submit" name="cartPay">
                </form>
            </div>
        </div>
