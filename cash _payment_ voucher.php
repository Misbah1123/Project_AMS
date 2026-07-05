<!-- ===== CASH PAYMENT VOUCHER ===== -->
    <div id="cpv" class="section">
    <div class="card">
        <h2>💸 Cash Payment Voucher</h2>
        <form method="POST">
            <input type="hidden" name="cpv_id" value="<?php echo $editCPV['id'] ?? ''; ?>">
            <div class="form-grid">
                <div class="form-group">
                    <label>Voucher No</label>
                    <input type="text" name="cpv_voucher_no" placeholder="CPV-0001"
                        value="<?php echo htmlspecialchars($editCPV['voucher_no'] ?? ('CPV-'.str_pad(count($_SESSION['cpv'])+1,4,'0',STR_PAD_LEFT))); ?>" required>
                </div>
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="cpv_date" value="<?php echo htmlspecialchars($editCPV['date'] ?? date('Y-m-d')); ?>" required>
                </div>
                <div class="form-group">
                    <label>Paid To</label>
                    <input type="text" name="cpv_paid_to" placeholder="Vendor / Party naam"
                        value="<?php echo htmlspecialchars($editCPV['paid_to'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Account</label>
                    <select name="cpv_account" required>
                        <option value="">-- Select Account --</option>
                        <?php foreach($_SESSION['coa'] as $a){
                            $s=(isset($editCPV['account'])&&$editCPV['account']==$a['name'])?'selected':'';
                            echo "<option value='{$a['name']}' $s>{$a['code']} - {$a['name']}</option>";
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Amount (PKR)</label>
                    <input type="number" name="cpv_amount" placeholder="0.00" min="1" step="0.01"
                        value="<?php echo htmlspecialchars($editCPV['amount'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Payment Mode</label>
                    <select name="cpv_payment_mode" required>
                        <?php foreach(['Cash','Cheque','Bank Transfer','IBFT'] as $m){
                            $s=(isset($editCPV['payment_mode'])&&$editCPV['payment_mode']==$m)?'selected':'';
                            echo "<option $s>$m</option>";
                        } ?>
                    </select>
                </div>
                <div class="form-group" style="grid-column:span 2;">
                    <label>Description / Narration</label>
                    <input type="text" name="cpv_description" placeholder="Payment ki wajah ya notes..."
                        value="<?php echo htmlspecialchars($editCPV['description'] ?? ''); ?>">
                </div>
            </div>
            <?php if($editCPV){ ?>
                <button class="btn-primary" name="update_cpv">✏️ Update Voucher</button>
                <a href="?" class="btn-cancel">Cancel</a>
            <?php } else { ?>
                <button class="btn-primary" name="add_cpv">➕ Add Voucher</button>
            <?php } ?>
        </form>

        <hr class="divider">

        <div class="summary-row">
            <div class="s-box"><div class="s-label">Total Vouchers</div><div class="s-val"><?php echo count($_SESSION['cpv']); ?></div></div>
            <div class="s-box"><div class="s-label">Total Paid (PKR)</div><div class="s-val"><?php echo number_format(array_sum(array_column($_SESSION['cpv'],'amount')),2); ?></div></div>
        </div>

        <table>
            <tr><th>#</th><th>Voucher No</th><th>Date</th><th>Paid To</th><th>Account</th><th>Amount (PKR)</th><th>Payment Mode</th><th>Description</th><th>Action</th></tr>
            <?php if(empty($_SESSION['cpv'])){ ?>
            <tr><td colspan="9" style="color:#aaa;padding:20px;font-style:italic;">Koi record nahi. Upar se add karein.</td></tr>
            <?php }
            $i=1; foreach(array_reverse($_SESSION['cpv']) as $r){
                $bc=match($r['payment_mode']){'Cash'=>'b-cash','Cheque'=>'b-cheque','Bank Transfer'=>'b-bank','IBFT'=>'b-ibft',default=>''};
            ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><strong><?php echo htmlspecialchars($r['voucher_no']); ?></strong></td>
                <td><?php echo htmlspecialchars($r['date']); ?></td>
                <td><?php echo htmlspecialchars($r['paid_to']); ?></td>
                <td><?php echo htmlspecialchars($r['account']); ?></td>
                <td style="color:#e53935;font-weight:bold;">PKR <?php echo number_format($r['amount'],2); ?></td>
                <td><span class="badge <?php echo $bc; ?>"><?php echo htmlspecialchars($r['payment_mode']); ?></span></td>
                <td><?php echo htmlspecialchars($r['description'] ?: '—'); ?></td>
                <td>
                    <a class="btn-edit" href="?edit_cpv=<?php echo $r['id']; ?>">Edit</a>
                    <a class="btn-delete" href="?delete_cpv=<?php echo $r['id']; ?>" onclick="return confirm('Delete karna chahti hain?')">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    </div>