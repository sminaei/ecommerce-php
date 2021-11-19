<div class="card mb-3">
    <div class="card-header">
سفارشات
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table float-right" style="direction: rtl">
            <thead>
            <tr>
                <th>ردیف</th>
                <th>نام</th>
                <th>قیمت</th>
                <th>شماره تراکنش</th>
                <th>وضعیت</th>

            </tr>
            </thead>
            <tbody>
            <?php
            $orders = mysqli_query($connection, "SELECT * FROM orders");
            while ($row = mysqli_fetch_array($orders)):
            ?>
            <tr>
                <td>1</td>

                <td><?php echo $row['name']?></td>
                <td><?php echo $row['price'] ?>></td>
                <td><?php echo $row['authority']?></td>
                <td><?php if($row['status'] == 100){
                    echo 'پرداخت شده';
                    }else{
                    echo 'پرداخت ناموفق ';
                    }
                    ?></td>
                <td>
                    <a href="#" class="btn btn-danger">حذف</a>
                </td>

            </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
                    </div>