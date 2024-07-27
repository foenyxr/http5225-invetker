<div class="modal fade" id="transaction-edit-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="transaction-edit-modal" aria-hidden="true">
  <div class="modal-dialog modal-lg with-nav-tab">
    <div class="modal-content">
      <ul class="nav nav-tabs px-4" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="edit-tab" data-bs-toggle="tab" data-bs-target="#edit-tab-pane"
            type="button" role="tab" aria-controls="edit-tab-pane" aria-selected="true">Transaction Edit</button>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="edit-tab-pane" role="tabpanel" aria-labelledby="edit-tab"
          tabindex="0">
          <form name="edit" role="form" action="api/transaction" method="POST" class="mt-3 needs-validation"
            novalidate>
            <div class="px-4">
              <div class="mb-3">
                <label for="ticker" class="form-label required">Ticker</label>
                <select id="ticker" class="form-control ticker" name="ticker" required></select>
              </div>
              <div class="mb-3">
                <label for="datetime" class="form-label required">Date and Time:</label>
                <input type="text" class="form-control date" id="datetime" name="datetime" required>
              </div>
              <div class="mb-3">
                <label for="quantity" class="form-label required">Quantity</label>
                <input id="quantity" class="form-control" name="quantity" type="number" step="0.001" min="0"
                  required />
              </div>
              <div class="mb-3">
                <label for="action" class="form-label required">Action</label>
                <select id="action" class="form-control" name="action">
                  <option>Sold</option>
                  <option>Bought</option>
                  <option>Deposit</option>
                  <option>Withdraw</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="price" class="form-label required">Price</label>
                <input id="price" class="form-control" name="price" type="number" step="0.001" min="0"
                  required />
              </div>
              <div class="mb-3">
                <label for="fee" class="form-label required">Fee</label>
                <input id="fee" class="form-control" name="fee" type="number" step="0.001" min="0"
                  required />
              </div>
            </div>
            <div class="modal-footer px-4">
              <input type="button" value="Close" class="btn btn-outline-secondary" data-bs-dismiss="modal" />
              <input type="submit" value="Edit" class="btn btn-warning text-light" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
