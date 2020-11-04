<!-- -----modal verifikasi----- -->
                            <!-- Modal -->
                            <div class="modal fade" id="verifikasi" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><a href="" class="close"
                                                    data-dismiss="modal" aria-label="Close"><i
                                                        class="fas fa-long-arrow-alt-left"></i></a></i>Masukkan Kode
                                                Verifikasi</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="bg-verifikasi">


                                                <div class="text-center">

                                                    <!-- -- -->
                                                    <!-- <form> -->
                                                    <label class="mb-3"> <span class="code_sms"> Kode Verifikasi telah
                                                            di kirim melalui sms ke</span> <br><span
                                                            class="number_sms">(+62) <script>document.getElementById('number').value;</script></span></label>
                                                    <div class="confirmation_code split_input large_bottom_margin"
                                                        data-multi-input-code="true">
                                                        <div class="confirmation_code_group ">
                                                            <input class="inline_input_" id="satu" maxlength="1">
                                                            <input class="inline_input_" id="dua" maxlength="1">
                                                            <input class="inline_input_" id="tiga" maxlength="1">
                                                            <input class="inline_input_" id="empat" maxlength="1">
                                                            <input class="inline_input_" id="lima" maxlength="1">
                                                            <input class="inline_input_" id="enam" maxlength="1">
                                                        </div>
                                                    </div>
                                                    <!-- -- -->
                                                    <div id="btn">
                                                    </div>
                                                    <!-- </form> -->
                                                    <span>Mohon tunggu <span>60 Detik</span> untuk mengirim ulang</span>
                                                </div>
                                                <a href="">Kirim Ulang</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

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