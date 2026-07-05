
    <!-- ===== TRANSFER VOUCHER ===== -->
    <div id="tv" class="section">
    <div class="card">
        <h2>🔁 Transfer Voucher</h2>
        <form method="POST">
            <input type="hidden" name="tv_id" value="<?php echo $editTV['id'] ?? ''; ?>">
            <input type="hidden" name="page" value="tv">
            <div class="form-grid">
                <div class="form-group">
                    <label>Voucher No</label>
                    <input type="text" name="tv_voucher_no" placeholder="TV-0001"
                        value="<?php echo htmlspecialchars($editTV['voucher_no'] ?? ('TV-'.str_pad(count($_SESSION['tv'])+1,4,'0',STR_PAD_LEFT))); ?>" required>
                </div>
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="tv_date" value="<?php echo htmlspecialchars($editTV['date'] ?? date('Y-m-d')); ?>" required>
                </div>
                <div class="form-group">
                    <label>Transfer From (Account)</label>
                    <select name="tv_from_account" required>
                        <option value="">-- Select Account --</option>
                        <?php foreach($_SESSION['coa'] as $a){
                            $s=(isset($editTV['from_account'])&&$editTV['from_account']==$a['name'])?'selected':'';
                            echo "<option value='{$a['name']}' $s>{$a['code']} - {$a['name']}</option>";
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Transfer To (Account)</label>
                    <select name="tv_to_account" required>
                        <option value="">-- Select Account --</option>
                        <?php foreach($_SESSION['coa'] as $a){
                            $s=(isset($editTV['to_account'])&&$editTV['to_account']==$a['name'])?'selected':'';
                            echo "<option value='{$a['name']}' $s>{$a['code']} - {$a['name']}</option>";
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Amount (PKR)</label>
                    <input type="number" name="tv_amount" placeholder="0.00" min="1" step="0.01"
                        value="<?php echo htmlspecialchars($editTV['amount'] ?? ''); ?>" required>
                </div>
                <div class="form-group" style="grid-column:span 2;">
                    <label>Description / Narration</label>
                    <input type="text" name="tv_description" placeholder="Transfer ki wajah ya notes..."
                        value="<?php echo htmlspecialchars($editTV['description'] ?? ''); ?>">
                </div>
            </div>
            <?php if($editTV){ ?>
                <button class="btn-primary" name="update_tv">✏️ Update Voucher</button>
                <a href="?page=tv" class="btn-cancel">Cancel</a>
            <?php } else { ?>
                <button class="btn-primary" name="add_tv">➕ Add Voucher</button>
            <?php } ?>
        </form>

        <hr class="divider">

        <div class="summary-row">
            <div class="s-box"><div class="s-label">Total Vouchers</div><div class="s-val"><?php echo count($_SESSION['tv']); ?></div></div>
            <div class="s-box"><div class="s-label">Total Transferred (PKR)</div><div class="s-val"><?php echo number_format(array_sum(array_column($_SESSION['tv'],'amount')),2); ?></div></div>
        </div>

        <table>
            <tr><th>#</th><th>Voucher No</th><th>Date</th><th>From Account</th><th>To Account</th><th>Amount (PKR)</th><th>Description</th><th>Action</th></tr>
            <?php if(empty($_SESSION['tv'])){ ?>
            <tr><td colspan="8" style="color:#aaa;padding:20px;font-style:italic;">Koi record nahi. Upar se add karein.</td></tr>
            <?php }
            $i=1; foreach(array_reverse($_SESSION['tv']) as $r){ ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><strong><?php echo htmlspecialchars($r['voucher_no']); ?></strong></td>
                <td><?php echo htmlspecialchars($r['date']); ?></td>
                <td><?php echo htmlspecialchars($r['from_account']); ?></td>
                <td><?php echo htmlspecialchars($r['to_account']); ?></td>
                <td style="color:#1565c0;font-weight:bold;">PKR <?php echo number_format($r['amount'],2); ?></td>
                <td><?php echo htmlspecialchars($r['description'] ?: '—'); ?></td>
                <td>
                    <a class="btn-edit" href="?edit_tv=<?php echo $r['id']; ?>&page=tv">Edit</a>
                    <a class="btn-delete" href="?delete_tv=<?php echo $r['id']; ?>&page=tv" onclick="return confirm('Delete karna chahti hain?')">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    </div>