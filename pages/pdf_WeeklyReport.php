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
        $this->Cell(210,10,'Weekly Sales Report',50,0,'C');
        $this->Line(10,40,199,40);
        $this->Ln(30);
    }
}

include "conn.php";
$sql = "SELECT item.item_ID, item.item_Name, item.item_unit, item.item_Brand, order_items.order_ID, order_items.orderItems_Quantity, order_items.orderItems_TotalPrice, orders.order_Date, orders.order_Total 
        FROM item 
        INNER JOIN order_items on order_items.item_ID = item.item_ID 
        INNER JOIN orders on orders.order_ID = order_items.order_ID";                                   
$result = mysqli_query($conn, $sql);
$res = mysqli_query($conn, $sql);

    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',8);

    //QUERY EDITED
        
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(95,10,'Order Date',1,0,'C');
    $pdf->Cell(95,10,'Total Sales',1,1,'C');
    $y = $pdf->GetY();
    $date = date("Y-m-d");
    $sql = "SELECT YEAR(order_Date) AS year, MONTHNAME(order_Date) AS month, WEEK(order_Date) AS week, order_Date, COUNT(DISTINCT orders.order_ID) AS totalOrders, SUM(orderItems_Quantity) AS totalItems, SUM(orderItems_TotalPrice) AS totalSales FROM orders INNER JOIN order_items ON (orders.order_ID = order_items.order_ID) GROUP BY WEEK(order_Date), MONTH(order_Date), YEAR(order_Date)" ;
    $result = mysqli_query($conn,$sql);
    $total = 0;
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck>0){
        while ($row = mysqli_fetch_assoc($result)) {
            $pdf->SetFont('Arial','',8);
            $y= $pdf ->GetY();
            $pdf->Cell(95,8,"Week ".$row['week']. " (" .$row['month'].", ".$row['year'] .")",1,0,'C');
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
    //END OF QUERY EDITED
    
        /*
        if(mysqli_num_rows($result) > 0)
        {
            $sql3 = "SELECT DISTINCT WEEK(order_Date), MONTHNAME(order_Date) from orders ORDER BY order_Date";
            $result3 = mysqli_query($conn, $sql3);
            foreach($result3 as $row)
            {
                $month = date("F Y", strtotime($row['MONTHNAME(order_Date)']));
                $timestamp1 = $row['WEEK(order_Date)'];
                $pdf->SetFont('Arial','B',12);
                $pdf->Cell(0,8,'Week '.$timestamp1.' ('.$month.')' ,1,0);
                $pdf->Ln(8);
                $sql1 = "SELECT DISTINCT order_items.order_ID, WEEK(orders.order_Date)  
                         FROM order_items
                         INNER JOIN orders on orders.order_ID = order_items.order_ID";
                $result1 = mysqli_query($conn, $sql1);
                foreach($result1 as $row)
                {
                    $timestamp = $row['WEEK(orders.order_Date)'];
                    //$month2 = date("n", strtotime($timestamp));
                    if($timestamp == $timestamp1)
                    {
                        $pdf->SetFont('Arial','B',10);
                        $pdf->Cell(0,8,"Order ID:".$row['order_ID'],1,0,'C');
                        $pdf->Ln(8);
                        $pdf->SetFont('Arial','B',8);
                        $pdf->Cell(30,10,'Order Date',1,0);
                        $pdf->Cell(20,10,'Item ID',1,0);
                        $pdf->Cell(45,10,'Item Name',1,0);
                        $pdf->Cell(25,10,'Item Unit',1,0);
                        $pdf->Cell(30,10,'Item Brand',1,0);
                        $pdf->Cell(20,10,'Quantity',1,0);
                        $pdf->Cell(20,10,'Order Total',1,1);
                        $y = $pdf->GetY();
                        $current = $row['order_ID'];
                        foreach($result as $row)
                        {
                            $previous = $row['order_ID'];
                            if($current == $previous)
                            {
                                $pdf->SetFont('Arial','',8);
                                $y= $pdf ->GetY();
                                $pdf->MultiCell(30,8,$row['order_Date'],1,'L');
                                $y1=$pdf ->GetY();
                                $pdf ->SetY($y);
                                $pdf ->Cell(30,5,'');$pdf->Cell(20,8,$row['item_ID'],1,0);
                                $pdf->Cell(45,8,$row['item_Name'],1,0);
                                $pdf->Cell(25,8,$row['item_unit'],1,0);
                                $pdf->Cell(30,8,$row['item_Brand'],1,0);
                                $pdf->Cell(20,8,$row['orderItems_Quantity'],1,0);
                                $pdf->Cell(20,8,$row['orderItems_TotalPrice'],1,1);   
                            }
                        }
                    }   
                        
                }$pdf ->SetY($y1+10);
            }    
        }
        else
        {
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(0,8,"No Record Found",0,'C');
        }*/
$pdf->Output();
?>
