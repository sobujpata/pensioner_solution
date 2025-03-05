  <!-- Footer -->
  <footer class="container-fluid footer text-center text-lg-start text-white"
      style="background-color: #45526e; border-radius:8px;">
      <!-- Grid container -->
      <div class="container-md pb-0" style="padding: 0rem 1.5rem 0rem 1.5rem!important;">
          <!-- Section: Links -->
          <section class="re-size-text">
              <!--Grid row-->
              <div class="row">
                  <!-- Grid column -->
                  <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3 px-0" style="text-align: center;">
                      <h6 class="text-uppercase mb-1 font-weight-bold text-white">pensioner solution</h6>
                      <p class="text-uppercase mb-1 font-weight-bold text-white">baf Record Office</p>
                      <img src="{{ asset('users/images/ro.png') }}" width="80px" alt="BAF logo">
                      <div align="center">
                          <!-- Start of CuterCounter Code -->
                          <span class="btn btn-outline-light btn-floating mt-2 mx-1">Visitors: <span
                                  id="visitors"></span></span>
                          <!-- End of CuterCounter Code -->
                      </div>
                  </div>
                  <!-- Grid column -->

                  <hr class="w-100 clearfix d-md-none" />

                  <!-- Grid column -->
                  <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3 text-left px-0">
                      <h6 class="text-uppercase mb-4 font-weight-bold text-white">Objectives</h6>
                      <p>
                          <a class="text-white re-size-p">To provide online service.</a>
                      </p>
                      <p>
                          <a class="text-white re-size-p">To reduce expenditure & time.</a>
                      </p>
                      <p>
                          <a class="text-white re-size-p">To reduce physical effort.</a>
                      </p>
                      <p>
                          <a class="text-white re-size-p">To provide 24/7 hours service.</a>
                      </p>

                  </div>
                  <!-- Grid column -->
                  <hr class="w-100 clearfix d-md-none" />

                  <!-- Grid column -->
                  <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3 text-left px-0">
                      <h6 class="text-uppercase mb-4 font-weight-bold text-white">Useful links</h6>
                      <p>
                          <a href="https://www.baf.mil.bd" class="text-white">Bangladesh Air Force</a>
                      </p>
                      <p>
                          <a href="https://www.surokkha.gov.bd" class="text-white">Surokkha.gov.bd</a>
                      </p>
                      <p>
                          <a href="https://ffighter.baf.mil.bd/" class="text-white">BAF Freedom Fighters Portal</a>
                      </p>
                      <p>
                          <a href="https://www.cafopfm.gov.bd/" class="text-white">Pensioner Payment Information</a>
                      </p>
                  </div>

                  <!-- Grid column -->
                  <hr class="w-100 clearfix d-md-none" />

                  <!-- Grid column -->
                  <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3 text-left px-0">
                      <h6 class="text-uppercase mb-4 font-weight-bold text-white">Contact</h6>
                      <p><i class="fas fa-home mr-3"></i> Old Airport, Tejgaon, Dhaka-1206</p>
                      <p><i class="fas fa-envelope mr-3"></i> psolution@baf.mil.bd</p>
                      <p><i class="fas fa-phone mr-3"></i> + 880 1769993546</p>
                      <p><i class="fas fa-phone mr-3"></i> 0255060000 Ext-3948</p>

                  </div>
                  <!-- Grid column -->
              </div>
              <!--Grid row-->
          </section>
          <!-- Section: Links -->

          <hr class="my-1 hr">

          <!-- Section: Copyright -->
          <section class="p-3 pt-0">
              <div class="row d-flex align-items-center">
                  <!-- Grid column -->
                  <div class="col-md-4 col-lg-4 ml-lg-0 text-center text-md-end">
                      <!-- Facebook -->
                      <a class="btn btn-outline-light btn-floating m-1" class="text-white"role="button"
                          href="https://www.facebook.com/baf.mil.bd" target="_blank"><i
                              class="fab fa-facebook-f"></i></a>
                      <!-- Twitter -->
                      <a class="btn btn-outline-light btn-floating m-1" class="text-white" role="button"
                          target="_blank" href="https://twitter.com/BD_Air_Force"><i class="fab fa-twitter"></i></a>
                      <!-- youtube -->
                      <a class="btn btn-outline-light btn-floating m-1" class="text-white" role="button"
                          target="_blank"href="https://www.youtube.com/channel/UCoipxGr6S_a_rQMukUFdCpw"><i
                              class="fab fa-youtube"></i></a>

                      <!-- Google -->
                      <a class="btn btn-outline-light btn-floating m-1" class="text-white" role="button"
                          target="_blank" href="mailto: ocro@baf.mil.bd"><i class="fab fa-google"></i></a>
                  </div>
                  <!-- Grid column -->
                  <!-- Grid column -->

                  <div class="col-md-8 col-lg-8 text-center text-md-start">
                      <!-- Copyright -->
                      <div class="row">

                          <div class="col-md-6">
                              <div class="p-3">
                                  <span style="font-size:11px !important;"> &#169; @php
                                      echo date('Y');
                                  @endphp Copyright: <a
                                          class="text-white" href="#">BAF Record Office. All
                                          Rights Reserved.</a></span>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="p-3">
                                  {{-- Developed By: BAF RECORD OFFICE. --}}
                                  {{-- <span style="font-size:11px !important;">Developed By: SWO Murad, Cy Asst and Cpl Salim, GS.</span> --}}
                                  <span style="font-size:11px !important;">Developed By: ICT Cell, BAF RO</span>
                              </div>
                          </div>
                      </div>

                      <!-- Copyright -->
                  </div>
                  <!-- Grid column -->


              </div>
          </section>
          <!-- Section: Copyright -->
      </div>
      <!-- Grid container -->
  </footer>
  <!-- Footer -->


  <!-- End of Footer -->
  <script>
      getVisitor();
      async function getVisitor() {
          let res = await axios.get('/visitor');

          document.getElementById('visitors').innerHTML = res.data;
      }
  </script>
  </body>

  </html>
