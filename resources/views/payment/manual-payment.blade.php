@extends("frontend.layouts.app")

@section('style')
<style>
  .uploader {
      display: block;
      clear: both;
      margin: 0 auto;
      width: 100%;
      max-width: 600px;
  }

  .uploader label {
      float: left;
      clear: both;
      width: 100%;
      padding: 2rem 1.5rem;
      text-align: center;
      background: #fff;
      border-radius: 7px;
      border: 3px solid #eee;
      -webkit-transition: all 0.2s ease;
      transition: all 0.2s ease;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
  }

  .uploader label:hover {
      border-color: #3B6CB6;
  }

  .uploader label.hover {
      border: 3px solid #3B6CB6;
      box-shadow: inset 0 0 0 6px #eee;
  }

  .uploader label.hover #start i.fa {
      -webkit-transform: scale(0.8);
      transform: scale(0.8);
      opacity: 0.3;
  }

  .uploader #start {
      float: left;
      clear: both;
      width: 100%;
  }

  .uploader #start.hidden {
      display: none;
  }

  .uploader #start i.fa {
      font-size: 50px;
      margin-bottom: 1rem;
      -webkit-transition: all 0.2s ease-in-out;
      transition: all 0.2s ease-in-out;
  }

  .uploader #response {
      float: left;
      clear: both;
      width: 100%;
  }

  .uploader #response.hidden {
      display: none;
  }

  .uploader #response #messages {
      margin-bottom: 0.5rem;
  }

  .uploader #file-image {
      display: inline;
      margin: 0 auto 0.5rem auto;
      width: auto;
      height: auto;
      max-width: 180px;
  }

  .uploader #file-image.hidden {
      display: none;
  }

  .uploader #notimage {
      display: block;
      float: left;
      clear: both;
      width: 100%;
  }

  .uploader #notimage.hidden {
      display: none;
  }

  .uploader progress,
  .uploader .progress {
      display: inline;
      clear: both;
      margin: 0 auto;
      width: 100%;
      max-width: 180px;
      height: 8px;
      border: 0;
      border-radius: 4px;
      background-color: #eee;
      overflow: hidden;
  }

  .uploader .progress[value]::-webkit-progress-bar {
      border-radius: 4px;
      background-color: #eee;
  }

  .uploader .progress[value]::-webkit-progress-value {
      background: -webkit-gradient(linear, left top, right top, from(#393f90), color-stop(50%, #3B6CB6));
      background: linear-gradient(to right, #393f90 0%, #3B6CB6 50%);
      border-radius: 4px;
  }

  .uploader .progress[value]::-moz-progress-bar {
      background: linear-gradient(to right, #393f90 0%, #3B6CB6 50%);
      border-radius: 4px;
  }

  .uploader input[type="file"] {
      display: none;
  }

  .uploader div {
      margin: 0 0 0.5rem 0;
      color: #5f6982;
  }

  .uploader .btn {
      display: inline-block;
      margin: 0.5rem 0.5rem 1rem 0.5rem;
      clear: both;
      font-family: inherit;
      font-weight: 700;
      font-size: 14px;
      text-decoration: none;
      text-transform: initial;
      border: none;
      border-radius: 0.2rem;
      outline: none;
      padding: 0 1rem;
      height: 36px;
      line-height: 36px;
      color: #fff;
      -webkit-transition: all 0.2s ease-in-out;
      transition: all 0.2s ease-in-out;
      box-sizing: border-box;
      background: #3B6CB6;
      border-color: #3B6CB6;
      cursor: pointer;
  }
</style>
@endsection

@section('content')
  <div class="row">
      <div class="col-2"></div>
      <div class="col-lg-8 col-12">
          <div class="card p-4">
              <div class="row">
                  <div class="col-1"></div>
                  <div class="col-10">

                      <div class="border-bottom pb-lg-3 pb-1">
                          <table>
                              <tr>
                                  <td class="w-100" style="font-size: 18px;">Total Pembayaran</td>
                                  <th style="color: #B71C1C; font-size: 18px;">Rp31.500</th>
                              </tr>
                          </table>
                      </div>
                      <div class="row mt-1 mt-lg-3">
                          <div class="col-4">
                              <span class="font-weight-bold">Metode Pembayaran</span>
                              <img src="bni-02.png" alt="" class="text-center" style="width: 60px; height: 60px; ">
                          </div>
                          <div class="col-8 border-left">
                              <table>
                                  <tr>
                                      <th class="pr-5">Bank</th>
                                      <td>: Bank BNI</td>
                                  </tr>
                                  <tr>
                                      <th>No. Rek</th>
                                      <td>: 54654 8845 2156</td>
                                  </tr>
                                  <tr>
                                      <th>a/n</th>
                                      <td>: Aninda Nitaa</td>
                                  </tr>
                              </table>
                          </div>
                      </div>


                      <div class="info-lanjut-konfirmasi__ my-5">
                          <!-- Upload  -->
                          <span class="text-muted">Upload Bukti Pembayaran (max. 3MB)</span>
                          <form id="file-upload-form" class="uploader mt-lg-2 mt-1">
                              <input id="file-upload" type="file" name="fileUpload" accept="image/*" />

                              <label for="file-upload" id="file-drag">
                                  <img id="file-image" src="#" alt="Preview" class="hidden">
                                  <div id="start">
                                      <i class="fa fa-download" aria-hidden="true"></i>
                                      <div>Select a file or drag here</div>
                                      <div id="notimage" class="hidden">Please select an image</div>
                                      <span id="file-upload-btn" class="btn btn-primary">Select a file</span>
                                  </div>
                                  <div id="response" class="hidden">
                                      <div id="messages"></div>
                                      <progress class="progress" id="file-progress" value="0">
                                          <span>0</span>%
                                      </progress>
                                  </div>
                              </label>
                          </form>
                      </div>

                      <div class="row mt-3 mt-lg-5">
                          <div class="col-6 text-center">
                              <a href="" class="btn btn-danger w-100">Batal</a>
                          </div>
                          <div class="col-6 text-center">
                              <a href="" class="btn btn-primary1 w-100">Konfirmasi Pembayaran</a>
                          </div>
                      </div>

                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection

@section('script')
    <script>

function ekUpload() {
        function Init() {

            console.log("Upload Initialised");

            var fileSelect = document.getElementById('file-upload'),
                fileDrag = document.getElementById('file-drag'),
                submitButton = document.getElementById('submit-button');

            fileSelect.addEventListener('change', fileSelectHandler, false);

            // Is XHR2 available?
            var xhr = new XMLHttpRequest();
            if (xhr.upload) {
                // File Drop
                fileDrag.addEventListener('dragover', fileDragHover, false);
                fileDrag.addEventListener('dragleave', fileDragHover, false);
                fileDrag.addEventListener('drop', fileSelectHandler, false);
            }
        }

        function fileDragHover(e) {
            var fileDrag = document.getElementById('file-drag');

            e.stopPropagation();
            e.preventDefault();

            fileDrag.className = (e.type === 'dragover' ? 'hover' : 'modal-body file-upload');
        }

        function fileSelectHandler(e) {
            // Fetch FileList object
            var files = e.target.files || e.dataTransfer.files;

            // Cancel event and hover styling
            fileDragHover(e);

            // Process all File objects
            for (var i = 0, f; f = files[i]; i++) {
                parseFile(f);
                uploadFile(f);
            }
        }

        // Output
        function output(msg) {
            // Response
            var m = document.getElementById('messages');
            m.innerHTML = msg;
        }

        function parseFile(file) {

            console.log(file.name);
            output(
                '<strong>' + encodeURI(file.name) + '</strong>'
            );

            // var fileType = file.type;
            // console.log(fileType);
            var imageName = file.name;

            var isGood = (/\.(?=gif|jpg|png|jpeg)/gi).test(imageName);
            if (isGood) {
                document.getElementById('start').classList.add("hidden");
                document.getElementById('response').classList.remove("hidden");
                document.getElementById('notimage').classList.add("hidden");
                // Thumbnail Preview
                document.getElementById('file-image').classList.remove("hidden");
                document.getElementById('file-image').src = URL.createObjectURL(file);
            } else {
                document.getElementById('file-image').classList.add("hidden");
                document.getElementById('notimage').classList.remove("hidden");
                document.getElementById('start').classList.remove("hidden");
                document.getElementById('response').classList.add("hidden");
                document.getElementById("file-upload-form").reset();
            }
        }

        function setProgressMaxValue(e) {
            var pBar = document.getElementById('file-progress');

            if (e.lengthComputable) {
                pBar.max = e.total;
            }
        }

        function updateFileProgress(e) {
            var pBar = document.getElementById('file-progress');

            if (e.lengthComputable) {
                pBar.value = e.loaded;
            }
        }

        function uploadFile(file) {

            var xhr = new XMLHttpRequest(),
                fileInput = document.getElementById('class-roster-file'),
                pBar = document.getElementById('file-progress'),
                fileSizeLimit = 1024; // In MB
            if (xhr.upload) {
                // Check if file is less than x MB
                if (file.size <= fileSizeLimit * 1024 * 1024) {
                    // Progress bar
                    pBar.style.display = 'inline';
                    xhr.upload.addEventListener('loadstart', setProgressMaxValue, false);
                    xhr.upload.addEventListener('progress', updateFileProgress, false);

                    // File received / failed
                    xhr.onreadystatechange = function (e) {
                        if (xhr.readyState == 4) {
                            // Everything is good!

                            // progress.className = (xhr.status == 200 ? "success" : "failure");
                            // document.location.reload(true);
                        }
                    };

                    // Start upload
                    xhr.open('POST', document.getElementById('file-upload-form').action, true);
                    xhr.setRequestHeader('X-File-Name', file.name);
                    xhr.setRequestHeader('X-File-Size', file.size);
                    xhr.setRequestHeader('Content-Type', 'multipart/form-data');
                    xhr.send(file);
                } else {
                    output('Please upload a smaller file (< ' + fileSizeLimit + ' MB).');
                }
            }
        }

        // Check for the various File API support.
        if (window.File && window.FileList && window.FileReader) {
            Init();
        } else {
            document.getElementById('file-drag').style.display = 'none';
        }
    }
    ekUpload();

    </script>
@endsection