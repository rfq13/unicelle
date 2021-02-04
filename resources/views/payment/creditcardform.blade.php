<form action="" method="post" id="ccform">
        @csrf
        <input type="hidden" name="xenditToken" id="xenditToken"/>
        <input type="hidden" name="authid" id="authid"/>
        <div class="form-group">
            <label for="AccountNumber">Account Number</label>
            <input type="number" name="ccnum" class="form-control" id="AccountNumber" placeholder="credit card account number" required>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="expmonth">exp month</label>
            <input type="number" class="form-control" id="expmonth" max="12" placeholder="Account Number" required>
            </div>
            <div class="form-group col-md-6">
            <label for="expyear">exp year</label>
            <input type="number" class="form-control" id="expyear" placeholder="number" required>
            </div>
        </div>
        <div class="form-group">
            <label for="cradcvn">CVN</label>
            <input type="text" name="cvn" class="form-control" id="cradcvn" placeholder="Apartment, studio, or floor" required>
        </div>
        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="text" class="form-control" name="amount" id="totalamount" placeholder="Total Harga">
        </div>
    <button type="submit" class="submit btn btn-primary">Confirm</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
</form>

<script>
    const ccform = $("#ccform")

    ccform.on('submit', function (e) {
        e.preventDefault()
        const submitbtn = document.getElementsByClassName('submit')
        $(submitbtn).text('mohon tunggu..').prop('disabled', true);
        tokenizeXendit()
    })
</script>