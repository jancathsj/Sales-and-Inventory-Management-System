<?php
require('fpdf.php');

class PDF extends FPDF{
    function Header(){
        $this->Image('logo.png',50,6,30);
        $this->SetFont('Arial','B',20);
        $this->Cell(80);
        $this->Cell(50,10,'Hardware Store',50,0,'C');
        $this->SetFont('Arial','B',15);
        $this->Ln(10);
        $this->Cell(210,10,'Sales Report',50,0,'C');
        $this->Line(10,40,199,40);
        $this->Ln(20);
        
    }
}
include "conn.php";
if(isset($_GET['from_date']) && isset($_GET['to_date']))
{
    $from_date = $_GET['from_date'];
    $to_date = $_GET['to_date'];
    //$to_date1=date_create($to_date);
    //$to_date1 = date($to_date1, strtotime('+1 day'));
    $to_date = date('Y-m-d', strtotime($_GET['to_date'].'+1 day'));
    

    $sql = "SELECT item.item_ID, item.item_Name, item.item_unit, item.item_Brand, order_items.order_ID, order_items.orderItems_Quantity, order_items.orderItems_TotalPrice, orders.order_Date, orders.order_Total 
            FROM item 
            INNER JOIN order_items on order_items.item_ID = item.item_ID 
            INNER JOIN orders on orders.order_ID = order_items.order_ID 
            WHERE orders.order_Date BETWEEN '$from_date' AND '$to_date'";                                   
    $result = mysqli_query($conn, $sql);
    
    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',12);
    if ($from_date==$to_date) {
        $labelDate=date_create($from_date);
        $labelDate = date_format($labelDate,"F d, Y");
    } else {
        $labelDate1=date_create($from_date);
        $labelDate1 = date_format($labelDate1,"F d, Y");
        $labelDate2=date_create($to_date);
        $labelDate2 = date_format($labelDate2,"F d, Y");
        $labelDate = $labelDate1 ." - " .$labelDate2;
    }
    $pdf->Cell(190,10,$labelDate,50,0,'C');
    $pdf->Line(10,40,199,40);
    $pdf->Ln(15);
    $pdf->SetFont('Arial','B',8);
    
    if(mysqli_num_rows($result) > 0)
    {
        $sql2 = "SELECT order_Date, COUNT(DISTINCT orders.order_ID) AS totalOrders, SUM(orderItems_Quantity) AS totalItems, SUM(orderItems_TotalPrice) AS totalSales FROM orders INNER JOIN order_items ON (orders.order_ID = order_items.order_ID) WHERE order_Date BETWEEN '$from_date' AND '$to_date' GROUP BY DAY(order_Date);";
        $result2 = mysqli_query($conn, $sql2);
  
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(95,12,'Order Date',1,0,'C');
            $pdf->Cell(95,12,'Total Sales',1,1,'C');
            $y = $pdf->GetY();
            $date = date("Y-m-d");
            $result = mysqli_query($conn,$sql);
            $resultCheck = mysqli_num_rows($result);
            $total = 0;
            if ($resultCheck>0){
                while ($row = mysqli_fetch_assoc($result2)) {
                    $pdf->SetFont('Arial','',8);
                    $y= $pdf ->GetY();
                    $pdf->Cell(95,8,$row['order_Date'],1,0,'C');
                    $pdf->Cell(95,8,number_format($row['totalSales'],2),1,1,'C');
                    $total = $total + $row['totalSales'];
                
                }
                $y= $pdf ->GetY();
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(95,8,'',0,0,'L');
                $pdf->Cell(95,8,'Grand Total:                       '.number_format($total,2),0,1,'L');
                $y1=$pdf ->GetY();
                $pdf ->SetY($y);
            $pdf ->SetY($y1+10);
            } else {
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(0,8,"No Record Found",0,'C');
            }

    }

//cho $to_date;
//echo $from_date;
}

$pdf->Output();
?>
