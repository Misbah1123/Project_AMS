<!-- ===== CASH WITHDRAWAL ===== -->
    <div id="cashwithdraw" class="section">
    <div class="card">
        <h2>🏧 Cash Withdrawal</h2>
        <form method="POST">
            <input type="hidden" name="csw_id" value="<?php echo $editCSW['id'] ?? ''; ?>">
            <input type="hidden" name="page" value="cashwithdraw">
            <div class="form-grid">
                <div class="form-group">
                    <label>Voucher No</label>
                    <input type="text" name="csw_voucher_no" placeholder="CW-0001"
                        value="<?php echo htmlspecialchars($editCSW['voucher_no'] ?? ('CW-'.str_pad(count($_SESSION['csw'])+1,4,'0',STR_PAD_LEFT))); ?>" required>
                </div>
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="csw_date" value="<?php echo htmlspecialchars($editCSW['date'] ?? date('Y-m-d')); ?>" required>
                </div>
                <div class="form-group">
                    <label>Withdraw From (Account)</label>
                    <select name="csw_account" required>
                        <option value="">-- Select Account --</option>
                        <?php foreach($_SESSION['coa'] as $a){
                            $s=(isset($editCSW['account'])&&$editCSW['account']==$a['name'])?'selected':'';
                            echo "<option value='{$a['name']}' $s>{$a['code']} - {$a['name']}</option>";
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Withdrawn By</label>
                    <input type="text" name="csw_withdrawn_by" placeholder="Staff member naam"
                        value="<?php echo htmlspecialchars($editCSW['withdrawn_by'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Amount (PKR)</label>
                    <input type="number" name="csw_amount" placeholder="0.00" min="1" step="0.01"
                        value="<?php echo htmlspecialchars($editCSW['amount'] ?? ''); ?>" required>
                </div>
                <div class="form-group" style="grid-column:span 2;">
                    <label>Description / Narration</label>
                    <input type="text" name="csw_description" placeholder="Withdrawal ki wajah ya notes..."
                        value="<?php echo htmlspecialchars($editCSW['description'] ?? ''); ?>">
                </div>
            </div>
            <?php if($editCSW){ ?>
                <button class="btn-primary" name="update_csw">✏️ Update Withdrawal</button>
                <a href="?page=cashwithdraw" class="btn-cancel">Cancel</a>
            <?php } else { ?>
                <button class="btn-primary" name="add_csw">➕ Add Withdrawal</button>
            <?php } ?>
        </form>
 
        <hr class="divider">
 
        <div class="summary-row">
            <div class="s-box"><div class="s-label">Total Withdrawals</div><div class="s-val"><?php echo count($_SESSION['csw']); ?></div></div>
            <div class="s-box"><div class="s-label">Total Withdrawn (PKR)</div><div class="s-val"><?php echo number_format(array_sum(array_column($_SESSION['csw'],'amount')),2); ?></div></div>
        </div>
 
        <table>
            <tr><th>#</th><th>Voucher No</th><th>Date</th><th>Account</th><th>Withdrawn By</th><th>Amount (PKR)</th><th>Description</th><th>Action</th></tr>
            <?php if(empty($_SESSION['csw'])){ ?>
            <tr><td colspan="8" style="color:#aaa;padding:20px;font-style:italic;">Koi record nahi. Upar se add karein.</td></tr>
            <?php }
            $i=1; foreach(array_reverse($_SESSION['csw']) as $r){ ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><strong><?php echo htmlspecialchars($r['voucher_no']); ?></strong></td>
                <td><?php echo htmlspecialchars($r['date']); ?></td>
                <td><?php echo htmlspecialchars($r['account']); ?></td>
                <td><?php echo htmlspecialchars($r['withdrawn_by']); ?></td>
                <td style="color:#e53935;font-weight:bold;">PKR <?php echo number_format($r['amount'],2); ?></td>
                <td><?php echo htmlspecialchars($r['description'] ?: '—'); ?></td>
                <td>
                    <a class="btn-edit" href="?edit_csw=<?php echo $r['id']; ?>&page=cashwithdraw">Edit</a>
                    <a class="btn-delete" href="?delete_csw=<?php echo $r['id']; ?>&page=cashwithdraw" onclick="return confirm('Delete karna chahti hain?')">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    </div>