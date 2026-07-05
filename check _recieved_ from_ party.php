<!-- ===== CHEQUE RECEIVED FROM PARTY ===== -->
<div id="cr" class="section">
<div class="card">
    <h2>📥 Cheque Received from Party</h2>
    <form method="POST">
        <input type="hidden" name="cr_id" value="<?php echo $editCR['id'] ?? ''; ?>">
        <input type="hidden" name="page" value="cr">
        <div class="form-grid">
            <div class="form-group">
                <label>Cheque No</label>
                <input type="text" name="cr_cheque_no" placeholder="e.g. 0998874"
                    value="<?php echo htmlspecialchars($editCR['cheque_no'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label>Date</label>
                <input type="date" name="cr_date" value="<?php echo htmlspecialchars($editCR['date'] ?? date('Y-m-d')); ?>" required>
            </div>
            <div class="form-group">
                <label>Party Name</label>
                <input type="text" name="cr_party_name" placeholder="Customer / Party naam"
                    value="<?php echo htmlspecialchars($editCR['party_name'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label>Account</label>
                <select name="cr_account" required>
                    <option value="">-- Select Account --</option>
                    <?php foreach($_SESSION['coa'] as $a){
                        $s=(isset($editCR['account'])&&$editCR['account']==$a['name'])?'selected':'';
                        echo "<option value='{$a['name']}' $s>{$a['code']} - {$a['name']}</option>";
                    } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Bank Name</label>
                <input type="text" name="cr_bank_name" placeholder="e.g. HBL, UBL, Meezan"
                    value="<?php echo htmlspecialchars($editCR['bank_name'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label>Amount (PKR)</label>
                <input type="number" name="cr_amount" placeholder="0.00" min="1" step="0.01"
                    value="<?php echo htmlspecialchars($editCR['amount'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="cr_status" required>
                    <?php foreach(['Pending','Cleared','Bounced','Cancelled'] as $st){
                        $s=(isset($editCR['status'])&&$editCR['status']==$st)?'selected':'';
                        echo "<option $s>$st</option>";
                    } ?>
                </select>
            </div>
            <div class="form-group" style="grid-column:span 2;">
                <label>Description / Narration</label>
                <input type="text" name="cr_description" placeholder="Cheque ki wajah ya notes..."
                    value="<?php echo htmlspecialchars($editCR['description'] ?? ''); ?>">
            </div>
        </div>
        <?php if($editCR){ ?>
            <button class="btn-primary" name="update_cr">✏️ Update Cheque</button>
            <a href="?page=cr" class="btn-cancel">Cancel</a>
        <?php } else { ?>
            <button class="btn-primary" name="add_cr">➕ Add Cheque</button>
        <?php } ?>
    </form>

    <hr class="divider">

    <div class="summary-row">
        <div class="s-box"><div class="s-label">Total Cheques</div><div class="s-val"><?php echo count($_SESSION['cr']); ?></div></div>
        <div class="s-box"><div class="s-label">Total Received (PKR)</div><div class="s-val"><?php echo number_format(array_sum(array_column($_SESSION['cr'],'amount')),2); ?></div></div>
    </div>

    <table>
        <tr><th>#</th><th>Cheque No</th><th>Date</th><th>Party Name</th><th>Account</th><th>Bank</th><th>Amount (PKR)</th><th>Status</th><th>Description</th><th>Action</th></tr>
        <?php if(empty($_SESSION['cr'])){ ?>
        <tr><td colspan="10" style="color:#aaa;padding:20px;font-style:italic;">Koi record nahi. Upar se add karein.</td></tr>
        <?php }
        $i=1; foreach(array_reverse($_SESSION['cr']) as $r){
            $sColor=match($r['status']){'Cleared'=>'background:#d4edda;color:#155724;','Pending'=>'background:#fff3cd;color:#856404;','Bounced'=>'background:#f8d7da;color:#721c24;','Cancelled'=>'background:#e2e3e5;color:#383d41;',default=>''};
        ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><strong><?php echo htmlspecialchars($r['cheque_no']); ?></strong></td>
            <td><?php echo htmlspecialchars($r['date']); ?></td>
            <td><?php echo htmlspecialchars($r['party_name']); ?></td>
            <td><?php echo htmlspecialchars($r['account']); ?></td>
            <td><?php echo htmlspecialchars($r['bank_name']); ?></td>
            <td style="color:green;font-weight:bold;">PKR <?php echo number_format($r['amount'],2); ?></td>
            <td><span class="badge" style="<?php echo $sColor; ?>"><?php echo htmlspecialchars($r['status']); ?></span></td>
            <td><?php echo htmlspecialchars($r['description'] ?: '—'); ?></td>
            <td>
                <a class="btn-edit" href="?edit_cr=<?php echo $r['id']; ?>&page=cr">Edit</a>
                <a class="btn-delete" href="?delete_cr=<?php echo $r['id']; ?>&page=cr" onclick="return confirm('Delete karna chahti hain?')">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
</div>