<!-- ===== IBFT ===== -->
    <div id="ibft" class="section">
    <div class="card">
        <h2>🔄 Interbank Funds Transfer (IBFT)</h2>
        <form method="POST">
            <input type="hidden" name="ibft_id" value="<?php echo $editIBFT['id'] ?? ''; ?>">
            <input type="hidden" name="page" value="ibft">
            <div class="form-grid">
                <div class="form-group">
                    <label>Voucher No</label>
                    <input type="text" name="ibft_voucher_no" placeholder="IBFT-0001"
                        value="<?php echo htmlspecialchars($editIBFT['voucher_no'] ?? ('IBFT-'.str_pad(count($_SESSION['ibft'])+1,4,'0',STR_PAD_LEFT))); ?>" required>
                </div>
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="ibft_date" value="<?php echo htmlspecialchars($editIBFT['date'] ?? date('Y-m-d')); ?>" required>
                </div>
                <div class="form-group">
                    <label>From Account</label>
                    <select name="ibft_from_account" required>
                        <option value="">-- Select Account --</option>
                        <?php foreach($_SESSION['coa'] as $a){
                            $s=(isset($editIBFT['from_account'])&&$editIBFT['from_account']==$a['name'])?'selected':'';
                            echo "<option value='{$a['name']}' $s>{$a['code']} - {$a['name']}</option>";
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>To Bank / Party (Beneficiary)</label>
                    <input type="text" name="ibft_to_bank" placeholder="e.g. UBL - Vendor Name"
                        value="<?php echo htmlspecialchars($editIBFT['to_bank'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Reference No</label>
                    <input type="text" name="ibft_reference_no" placeholder="e.g. IBFT20260613A"
                        value="<?php echo htmlspecialchars($editIBFT['reference_no'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Amount (PKR)</label>
                    <input type="number" name="ibft_amount" placeholder="0.00" min="1" step="0.01"
                        value="<?php echo htmlspecialchars($editIBFT['amount'] ?? ''); ?>" required>
                </div>
                <div class="form-group" style="grid-column:span 2;">
                    <label>Description / Narration</label>
                    <input type="text" name="ibft_description" placeholder="Transfer ki wajah ya notes..."
                        value="<?php echo htmlspecialchars($editIBFT['description'] ?? ''); ?>">
                </div>
            </div>
            <?php if($editIBFT){ ?>
                <button class="btn-primary" name="update_ibft">✏️ Update IBFT</button>
                <a href="?page=ibft" class="btn-cancel">Cancel</a>
            <?php } else { ?>
                <button class="btn-primary" name="add_ibft">➕ Add IBFT</button>
            <?php } ?>
        </form>
 
        <hr class="divider">
 
        <div class="summary-row">
            <div class="s-box"><div class="s-label">Total Transfers</div><div class="s-val"><?php echo count($_SESSION['ibft']); ?></div></div>
            <div class="s-box"><div class="s-label">Total Transferred (PKR)</div><div class="s-val"><?php echo number_format(array_sum(array_column($_SESSION['ibft'],'amount')),2); ?></div></div>
        </div>
 
        <table>
            <tr><th>#</th><th>Voucher No</th><th>Date</th><th>From Account</th><th>To Bank / Party</th><th>Reference No</th><th>Amount (PKR)</th><th>Description</th><th>Action</th></tr>
            <?php if(empty($_SESSION['ibft'])){ ?>
            <tr><td colspan="9" style="color:#aaa;padding:20px;font-style:italic;">Koi record nahi. Upar se add karein.</td></tr>
            <?php }
            $i=1; foreach(array_reverse($_SESSION['ibft']) as $r){ ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><strong><?php echo htmlspecialchars($r['voucher_no']); ?></strong></td>
                <td><?php echo htmlspecialchars($r['date']); ?></td>
                <td><?php echo htmlspecialchars($r['from_account']); ?></td>
                <td><?php echo htmlspecialchars($r['to_bank']); ?></td>
                <td><?php echo htmlspecialchars($r['reference_no']); ?></td>
                <td style="color:#1565c0;font-weight:bold;">PKR <?php echo number_format($r['amount'],2); ?></td>
                <td><?php echo htmlspecialchars($r['description'] ?: '—'); ?></td>
                <td>
                    <a class="btn-edit" href="?edit_ibft=<?php echo $r['id']; ?>&page=ibft">Edit</a>
                    <a class="btn-delete" href="?delete_ibft=<?php echo $r['id']; ?>&page=ibft" onclick="return confirm('Delete karna chahti hain?')">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    </div>
 
</div>
 