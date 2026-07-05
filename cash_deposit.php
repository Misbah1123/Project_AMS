<!-- ===== CASH DEPOSIT ===== -->
    <div id="cashdeposit" class="section">
    <div class="card">
        <h2>💰 Cash Deposit</h2>
        <form method="POST">
            <input type="hidden" name="csd_id" value="<?php echo $editCSD['id'] ?? ''; ?>">
            <input type="hidden" name="page" value="cashdeposit">
            <div class="form-grid">
                <div class="form-group">
                    <label>Voucher No</label>
                    <input type="text" name="csd_voucher_no" placeholder="CD-0001"
                        value="<?php echo htmlspecialchars($editCSD['voucher_no'] ?? ('CD-'.str_pad(count($_SESSION['csd'])+1,4,'0',STR_PAD_LEFT))); ?>" required>
                </div>
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="csd_date" value="<?php echo htmlspecialchars($editCSD['date'] ?? date('Y-m-d')); ?>" required>
                </div>
                <div class="form-group">
                    <label>Deposit Into (Account)</label>
                    <select name="csd_account" required>
                        <option value="">-- Select Account --</option>
                        <?php foreach($_SESSION['coa'] as $a){
                            $s=(isset($editCSD['account'])&&$editCSD['account']==$a['name'])?'selected':'';
                            echo "<option value='{$a['name']}' $s>{$a['code']} - {$a['name']}</option>";
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Deposited By</label>
                    <input type="text" name="csd_deposited_by" placeholder="Staff member naam"
                        value="<?php echo htmlspecialchars($editCSD['deposited_by'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Amount (PKR)</label>
                    <input type="number" name="csd_amount" placeholder="0.00" min="1" step="0.01"
                        value="<?php echo htmlspecialchars($editCSD['amount'] ?? ''); ?>" required>
                </div>
                <div class="form-group" style="grid-column:span 2;">
                    <label>Description / Narration</label>
                    <input type="text" name="csd_description" placeholder="Deposit ki wajah ya notes..."
                        value="<?php echo htmlspecialchars($editCSD['description'] ?? ''); ?>">
                </div>
            </div>
            <?php if($editCSD){ ?>
                <button class="btn-primary" name="update_csd">✏️ Update Deposit</button>
                <a href="?page=cashdeposit" class="btn-cancel">Cancel</a>
            <?php } else { ?>
                <button class="btn-primary" name="add_csd">➕ Add Deposit</button>
            <?php } ?>
        </form>
 
        <hr class="divider">
 
        <div class="summary-row">
            <div class="s-box"><div class="s-label">Total Deposits</div><div class="s-val"><?php echo count($_SESSION['csd']); ?></div></div>
            <div class="s-box"><div class="s-label">Total Deposited (PKR)</div><div class="s-val"><?php echo number_format(array_sum(array_column($_SESSION['csd'],'amount')),2); ?></div></div>
        </div>
 
        <table>
            <tr><th>#</th><th>Voucher No</th><th>Date</th><th>Account</th><th>Deposited By</th><th>Amount (PKR)</th><th>Description</th><th>Action</th></tr>
            <?php if(empty($_SESSION['csd'])){ ?>
            <tr><td colspan="8" style="color:#aaa;padding:20px;font-style:italic;">Koi record nahi. Upar se add karein.</td></tr>
            <?php }
            $i=1; foreach(array_reverse($_SESSION['csd']) as $r){ ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><strong><?php echo htmlspecialchars($r['voucher_no']); ?></strong></td>
                <td><?php echo htmlspecialchars($r['date']); ?></td>
                <td><?php echo htmlspecialchars($r['account']); ?></td>
                <td><?php echo htmlspecialchars($r['deposited_by']); ?></td>
                <td style="color:green;font-weight:bold;">PKR <?php echo number_format($r['amount'],2); ?></td>
                <td><?php echo htmlspecialchars($r['description'] ?: '—'); ?></td>
                <td>
                    <a class="btn-edit" href="?edit_csd=<?php echo $r['id']; ?>&page=cashdeposit">Edit</a>
                    <a class="btn-delete" href="?delete_csd=<?php echo $r['id']; ?>&page=cashdeposit" onclick="return confirm('Delete karna chahti hain?')">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    </div>