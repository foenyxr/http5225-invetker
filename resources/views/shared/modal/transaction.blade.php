<div class="modal fade" id="transaction-add-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="transaction-add-modal" aria-hidden="true">
  <div class="modal-dialog modal-lg with-nav-tab">
    <div class="modal-content">
      <ul class="nav nav-tabs px-4" id="addTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="manually-tab" data-bs-toggle="tab" data-bs-target="#manually-tab-pane"
            type="button" role="tab" aria-controls="manually-tab-pane" aria-selected="true">Manually Add</button>
        </li>
      </ul>
      <div class="tab-content" id="addTabContent">
        <div class="tab-pane fade show active" id="manually-tab-pane" role="tabpanel" aria-labelledby="manually-tab"
          tabindex="0">
          <form name="add" action="api/transaction" method="POST" class="mt-3 needs-validation"
            novalidate>
            <div class="px-4">
              <div class="mb-3">
                <label class="form-label required">Ticker</label>
                <input class="form-control ticker" name="ticker" required>
              </div>
              <div class="mb-3">
                <label for="datetime" class="form-label required">Date and Time:</label>
                <input type="text" class="form-control date" id="datetime" name="datetime" required>
              </div>
              <div class="mb-3">
                <label for="quantity" class="form-label required">Quantity</label>
                <input id="quantity" class="form-control" name="quantity" type="number" step="0.001" min="0"
                  required>
              </div>
              <div class="mb-3">
                <label for="action" class="form-label required">Action</label>
                <select id="action" class="form-control" name="action">
                  <option>Bought</option>
                  <option>Sold</option>
                  <option>Deposit</option>
                  <option>Withdraw</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="price" class="form-label required">Price</label>
                <input id="price" class="form-control" name="price" type="number" step="0.001" min="0"
                  required>
              </div>
              <div class="mb-3">
                <label for="fee" class="form-label required">Fee</label>
                <input id="fee" class="form-control" name="fee" type="number" step="0.001" min="0"
                  required>
              </div>
            </div>
            <div class="modal-footer px-4">
              <input type="button" value="Close" class="btn btn-outline-secondary" data-bs-dismiss="modal">
              <input type="submit" value="Add" class="btn btn-warning text-light">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
