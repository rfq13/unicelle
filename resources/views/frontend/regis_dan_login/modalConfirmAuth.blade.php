<!-- -----modal verifikasi----- -->
                            <!-- Modal -->
                            <div class="modal fade" id="verifikasi" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                           
                                        </div>
                                        <div class="modal-body">
                                            <div class="bg-verifikasi">


                                                <div class="text-center">

                                                    <!-- -- -->
                                                    <!-- <form> -->
                                                    <label class="mb-3"> <span class="code_sms"> Kode Verifikasi telah
                                                            di kirim melalui sms ke</span> <br><span
                                                            class="number_sms" style="display: flex;justify-content: center;">(+62) <p id="p2"></p></span></label>

                                                    <!-- -- -->
                                                    <div id="btn">
                                                    </div>
                                                    <!-- </form> -->
                                                    <span>Mohon tunggu <span id="detik"></span> detik untuk mengirim ulang</span>
                                                </div>
                                                <div class="form-group">
                                    <div id="recaptcha-container"></div>
                                </div>                                                
                                <button type="submit" class="btn btn-secondary1 mb-2" style="width: 100%;">
                                    <a href="#"></a>Daftar
                                </button>                                            
                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form id="form_lanjutan" action="{{ url('users/registrationOtp') }}" method="GET">
                            <input type="hidden" name="uid">
                            <input type="hidden" name="nomor_hp">
                        </form>
                            <script>
                                var containers = document.querySelectorAll(".inline_input_");
                                containers.forEach(function (container) {
                                    container.onkeyup = function(e) {
                                        var target = e.srcElement;
                                        var maxLength = parseInt(target.attributes["maxlength"].value);
                                        var myLength = target.value.length;
                                        if (myLength >= maxLength) {
                                            var next = target;
                                            while (next = next.nextElementSibling) {
                                                if (next == null)
                                                    break;
                                                if (next.tagName.toLowerCase() == "input") {
                                                    next.focus();
                                                    break;
                                                }
                                            }
                                        }
                                    }
                                })
                            </script>