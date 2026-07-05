<!-- ===== CHEQUE DEPOSIT ===== -->
    <div id="cd" class="section">
    <div class="card">
        <h2>🏦 Cheque Deposit</h2>
        <form method="POST">
            <input type="hidden" name="cd_id" value="<?php echo $editCD['id'] ?? ''; ?>">
            <input type="hidden" name="page" value="cd">
            <div class="form-grid">
                <div class="form-group">
                    <label>Cheque No</label>
                    <input type="text" name="cd_cheque_no" placeholder="e.g. 0998876"
                        value="<?php echo htmlspecialchars($editCD['cheque_no'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="cd_date" value="<?php echo htmlspecialchars($editCD['date'] ?? date('Y-m-d')); ?>" required>
                </div>
                <div class="form-group">
                    <label>Received From (Party)</label>
                    <input type="text" name="cd_party_name" placeholder="Customer / Party naam"
                        value="<?php echo htmlspecialchars($editCD['party_name'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Deposit Account</label>
                    <select name="cd_deposit_account" required>
                        <option value="">-- Select Account --</option>
                        <?php foreach($_SESSION['coa'] as $a){
                            $s=(isset($editCD['deposit_account'])&&$editCD['deposit_account']==$a['name'])?'selected':'';
                            echo "<option value='{$a['name']}' $s>{$a['code']} - {$a['name']}</option>";
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Bank Name</label>
                    <input type="text" name="cd_bank_name" placeholder="e.g. HBL, UBL, Meezan"
                        value="<?php echo htmlspecialchars($editCD['bank_name'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Amount (PKR)</label>
                    <input type="number" name="cd_amount" placeholder="0.00" min="1" step="0.01"
                        value="<?php echo htmlspecialchars($editCD['amount'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="cd_status" required>
                        <?php foreach(['Pending','Cleared','Bounced'] as $st){
                            $s=(isset($editCD['status'])&&$editCD['status']==$st)?'selected':'';
                            echo "<option $s>$st</option>";
                        } ?>
                    </select>
                </div>
                <div class="form-group" style="grid-column:span 2;">
                    <label>Description / Narration</label>
                    <input type="text" name="cd_description" placeholder="Deposit ki wajah ya notes..."
                        value="<?php echo htmlspecialchars($editCD['description'] ?? ''); ?>">
                </div>
            </div>
            <?php if($editCD){ ?>
                <button class="btn-primary" name="update_cd">✏️ Update Deposit</button>
                <a href="?page=cd" class="btn-cancel">Cancel</a>
            <?php } else { ?>
                <button class="btn-primary" name="add_cd">➕ Add Deposit</button>
            <?php } ?>
        </form>
 
        <hr class="divider">
 
        <div class="summary-row">
            <div class="s-box"><div class="s-label">Total Cheques</div><div class="s-val"><?php echo count($_SESSION['cd']); ?></div></div>
            <div class="s-box"><div class="s-label">Total Deposited (PKR)</div><div class="s-val"><?php echo number_format(array_sum(array_column($_SESSION['cd'],'amount')),2); ?></div></div>
        </div>
 
        <table>
            <tr><th>#</th><th>Cheque No</th><th>Date</th><th>Received From</th><th>Deposit Account</th><th>Bank</th><th>Amount (PKR)</th><th>Status</th><th>Description</th><th>Action</th></tr>
            <?php if(empty($_SESSION['cd'])){ ?>
            <tr><td colspan="10" style="color:#aaa;padding:20px;font-style:italic;">Koi record nahi. Upar se add karein.</td></tr>
            <?php }
            $i=1; foreach(array_reverse($_SESSION['cd']) as $r){
                $sColor=match($r['status']){'Cleared'=>'background:#d4edda;color:#155724;','Pending'=>'background:#fff3cd;color:#856404;','Bounced'=>'background:#f8d7da;color:#721c24;',default=>''};
            ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><strong><?php echo htmlspecialchars($r['cheque_no']); ?></strong></td>
                <td><?php echo htmlspecialchars($r['date']); ?></td>
                <td><?php echo htmlspecialchars($r['party_name']); ?></td>
                <td><?php echo htmlspecialchars($r['deposit_account']); ?></td>
                <td><?php echo htmlspecialchars($r['bank_name']); ?></td>
                <td style="color:green;font-weight:bold;">PKR <?php echo number_format($r['amount'],2); ?></td>
                <td><span class="badge" style="<?php echo $sColor; ?>"><?php echo htmlspecialchars($r['status']); ?></span></td>
                <td><?php echo htmlspecialchars($r['description'] ?: '—'); ?></td>
                <td>
                    <a class="btn-edit" href="?edit_cd=<?php echo $r['id']; ?>&page=cd">Edit</a>
                    <a class="btn-delete" href="?delete_cd=<?php echo $r['id']; ?>&page=cd" onclick="return confirm('Delete karna chahti hain?')">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    </div>