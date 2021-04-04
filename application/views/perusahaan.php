 <!-- content -->
 <div id="content-wrapper" class="d-flex flex-column">

     <!-- main content -->
     <div id="content">

         <div class="row mt-3 mb-4">
             <h2>Perusahaan</h2>
         </div>

         <div class="row mb-4">

             <div class="col-lg-9 mb-4">
                 <form action="<?= site_url('add_perusahaan') ?>" method="post">
                     <h6>Data Perusahaan</h6>
                     <div class="form-row">
                         <div class="col-lg-7">
                             <input type="text" name="nama" placeholder="Nama Perusahaan" class="form-control my-3 p-4" required>
                         </div>
                     </div>

                     <div class="form-row">
                         <div class="col-lg-7">
                             <input type="text" name="alamat" placeholder="Alamat" class="form-control my-3 p-4" required>
                         </div>
                     </div>

                     <div class="form-row">
                         <div class="col-lg-7">
                             <input type="text" name="email" placeholder="Email" class="form-control my-3 p-4" required>
                         </div>
                     </div>

                     <div class="form-row">
                         <div class="col-lg-7">
                             <input type="text" name="no_telp" placeholder="No Telp" class="form-control my-3 p-4" required>
                         </div>
                     </div>
                     <div class="form-row">
                         <div class="col-lg-7">
                             <button type="submit" class="btn1 mt-3 mb-5">Submit</button>
                         </div>
                     </div>
                 </form>
             </div>

         </div>
     </div>
 </div>

 <footer class="sticky-footer bg-white">
     <div class="container my-auto">
         <div class="copyright text-center my-auto">
             <span>Copyright &copy; IOS Developer 2021</span>
         </div>
     </div>
 </footer>

 </div>