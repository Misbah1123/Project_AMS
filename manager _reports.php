  <!-- ===== REPORTS ===== -->
    <div id="reports" class="section">
    <div class="card">
        <h2>📑 Reports</h2>

        <div class="report-info no-print">
         

            <strong>Available Reports:</strong>
            <div class="report-list">
                <div class="report-list-item">📊 Chart of Accounts Report</div>
                <div class="report-list-item">📒 General Ledger Report</div>
                <div class="report-list-item">🧾 Voucher Report</div>
                <div class="report-list-item">🏦 Banking Transaction Report</div>
            </div>

           
        </div>

        <form method="GET" class="no-print">
            <input type="hidden" name="page" value="reports">
            <div class="form-grid">
                <div class="form-group">
                    <label>Report Type</label>
                    <select name="report_type" required>
                        <option value="">-- Select Report Type --</option>
                        <option value="coa" <?php echo $reportType=='coa'?'selected':''; ?>>Chart of Accounts Report</option>
                        <option value="ledger" <?php echo $reportType=='ledger'?'selected':''; ?>>General Ledger Report</option>
                        <option value="vouchers" <?php echo $reportType=='vouchers'?'selected':''; ?>>Voucher Report</option>
                        <option value="banking" <?php echo $reportType=='banking'?'selected':''; ?>>Banking Transaction Report</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Date From</label>
                    <input type="date" name="report_from" value="<?php echo htmlspecialchars($reportFrom); ?>">
                </div>
                <div class="form-group">
                    <label>Date To</label>
                    <input type="date" name="report_to" value="<?php echo htmlspecialchars($reportTo); ?>">
                </div>
            </div>
            <button class="btn-primary" name="generate_report">📑 Generate Report</button>
            <?php if($reportGenerated){ ?>
                <a href="?page=reports" class="btn-cancel">✖ Clear</a>
            <?php } ?>
        </form>

        <?php if($reportGenerated){ ?>
        <div class="report-output">

            <div class="report-title">
                <?php
                $reportTitles = [
                    'coa'      => 'Chart of Accounts Report',
                    'ledger'   => 'General Ledger Report',
                    'vouchers' => 'Voucher Report',
                    'banking'  => 'Banking Transaction Report'
                ];
                echo htmlspecialchars($reportTitles[$reportType] ?? 'Report');
                ?>
            </div>
            <div class="report-meta">
                Generated on <?php echo date('Y-m-d H:i'); ?>
                <?php if($reportFrom || $reportTo){ ?>
                    | Period: <?php echo htmlspecialchars($reportFrom ?: 'Start'); ?> to <?php echo htmlspecialchars($reportTo ?: 'Today'); ?>
                <?php } ?>
            </div>

            <?php if($reportType=='coa'){ ?>
                <table>
                    <tr><th>ID</th><th>Code</th><th>Account Name</th><th>Type</th></tr>
                    <?php if(empty($reportRows)){ ?>
                    <tr><td colspan="4" style="color:#aaa;padding:20px;font-style:italic;">No records found.</td></tr>
                    <?php }
                    foreach($reportRows as $r){ ?>
                    <tr>
                        <td><?php echo $r['id']; ?></td>
                        <td><?php echo htmlspecialchars($r['code']); ?></td>
                        <td><?php echo htmlspecialchars($r['name']); ?></td>
                        <td><?php echo htmlspecialchars($r['type']); ?></td>
                    </tr>
                    <?php } ?>
                </table>

            <?php } elseif($reportType=='ledger'){ ?>
                <table>
                    <tr><th>ID</th><th>Code</th><th>Account Name</th><th>Debit (PKR)</th><th>Credit (PKR)</th></tr>
                    <?php if(empty($reportRows)){ ?>
                    <tr><td colspan="5" style="color:#aaa;padding:20px;font-style:italic;">No records found.</td></tr>
                    <?php }
                    foreach($reportRows as $r){ ?>
                    <tr>
                        <td><?php echo $r['id']; ?></td>
                        <td><?php echo htmlspecialchars($r['code']); ?></td>
                        <td><?php echo htmlspecialchars($r['name']); ?></td>
                        <td style="color:green;font-weight:bold;"><?php echo number_format($r['debit'],2); ?></td>
                        <td style="color:#e53935;font-weight:bold;"><?php echo number_format($r['credit'],2); ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(!empty($reportRows)){ ?>
                    <tr>
                        <td colspan="3" style="text-align:right;font-weight:bold;">Total</td>
                        <td style="color:green;font-weight:bold;"><?php echo number_format(array_sum(array_column($reportRows,'debit')),2); ?></td>
                        <td style="color:#e53935;font-weight:bold;"><?php echo number_format(array_sum(array_column($reportRows,'credit')),2); ?></td>
                    </tr>
                    <?php } ?>
                </table>

            <?php } elseif($reportType=='vouchers'){ ?>
                <table>
                    <tr><th>Voucher Type</th><th>Voucher No</th><th>Date</th><th>Party / Account</th><th>Account</th><th>Nature</th><th>Amount (PKR)</th></tr>
                    <?php if(empty($reportRows)){ ?>
                    <tr><td colspan="7" style="color:#aaa;padding:20px;font-style:italic;">No records found for the selected period.</td></tr>
                    <?php }
                    foreach($reportRows as $r){ ?>
                    <tr>
                        <td><?php echo htmlspecialchars($r['type']); ?></td>
                        <td><strong><?php echo htmlspecialchars($r['voucher_no']); ?></strong></td>
                        <td><?php echo htmlspecialchars($r['date']); ?></td>
                        <td><?php echo htmlspecialchars($r['party']); ?></td>
                        <td><?php echo htmlspecialchars($r['account']); ?></td>
                        <td><?php echo htmlspecialchars($r['nature']); ?></td>
                        <td style="font-weight:bold;">PKR <?php echo number_format($r['amount'],2); ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(!empty($reportRows)){ ?>
                    <tr>
                        <td colspan="6" style="text-align:right;font-weight:bold;">Total</td>
                        <td style="font-weight:bold;">PKR <?php echo number_format(array_sum(array_column($reportRows,'amount')),2); ?></td>
                    </tr>
                    <?php } ?>
                </table>

            <?php } elseif($reportType=='banking'){ ?>
                <table>
                    <tr><th>Transaction Type</th><th>Reference No</th><th>Date</th><th>Party / Beneficiary</th><th>Bank / Account</th><th>Amount (PKR)</th><th>Status</th></tr>
                    <?php if(empty($reportRows)){ ?>
                    <tr><td colspan="7" style="color:#aaa;padding:20px;font-style:italic;">No records found for the selected period.</td></tr>
                    <?php }
                    foreach($reportRows as $r){ ?>
                    <tr>
                        <td><?php echo htmlspecialchars($r['type']); ?></td>
                        <td><strong><?php echo htmlspecialchars($r['ref_no']); ?></strong></td>
                        <td><?php echo htmlspecialchars($r['date']); ?></td>
                        <td><?php echo htmlspecialchars($r['party']); ?></td>
                        <td><?php echo htmlspecialchars($r['bank']); ?></td>
                        <td style="font-weight:bold;">PKR <?php echo number_format($r['amount'],2); ?></td>
                        <td><?php echo htmlspecialchars($r['status']); ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(!empty($reportRows)){ ?>
                    <tr>
                        <td colspan="5" style="text-align:right;font-weight:bold;">Total</td>
                        <td style="font-weight:bold;">PKR <?php echo number_format(array_sum(array_column($reportRows,'amount')),2); ?></td>
                        <td></td>
                    </tr>
                    <?php } ?>
                </table>
            <?php } ?>

            <div class="no-print" style="margin-top:18px;">
                <button class="btn-print" onclick="window.print()">🖨️ Print Report</button>
            </div>
        </div>
        <?php } ?>

    </div>
    </div>

</div>
