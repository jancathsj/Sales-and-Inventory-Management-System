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
    $date = $_GET['to_date'];
    $to_date = date($date, strtotime('+1 day'));
    $to_date = date("Y-m-d",strtotime('+1 day'));
    //$to_date = date('Y-m-d', strtotime($_GET['to_date'].'+1 day'));
    

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
            $pdf->SetFont('Arial','B',10);
            $pdf->Ln(8);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(30,10,'Order Date',1,0);
            $pdf->Cell(15,10,'Order ID',1,0);
            $pdf->Cell(15,10,'Item ID',1,0);
            $pdf->Cell(45,10,'Item Name',1,0);
            $pdf->Cell(15,10,'Item Unit',1,0);
            $pdf->Cell(30,10,'Item Brand',1,0);
            $pdf->Cell(20,10,'Quantity',1,0);
            $pdf->Cell(20,10,'Order Total',1,1);
            $y = $pdf->GetY();

            $sql3 = "SELECT DISTINCT (DATE(order_Date)) from orders WHERE order_Date BETWEEN '$from_date' AND '$to_date'";
            $result3 = mysqli_query($conn, $sql3);

            foreach($result3 as $row)
            {
                $date = date("Y-m-d", strtotime($row['(DATE(order_Date))']));
                $sql1 = "SELECT DISTINCT order_items.order_ID, orders.order_Date  
                            FROM order_items
                            INNER JOIN orders on orders.order_ID = order_items.order_ID";
                $result1 = mysqli_query($conn, $sql1);


                foreach($result1 as $row)
                {
                    $date2 = date("Y-m-d", strtotime($row['order_Date']));
                    if($date2 == $date)
                    {
                        

                        $result2 = mysqli_query($conn, $sql);
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
                                $pdf ->Cell(30,5,'');
                                $pdf->Cell(15,8,$row['order_ID'],1,0);
                                $pdf->Cell(15,8,$row['item_ID'],1,0);
                                $pdf->Cell(45,8,$row['item_Name'],1,0);
                                $pdf->Cell(15,8,$row['item_unit'],1,0);
                                $pdf->Cell(30,8,$row['item_Brand'],1,0);
                                $pdf->Cell(20,8,$row['orderItems_Quantity'],1,0);
                                $pdf->Cell(20,8,number_format($row['orderItems_TotalPrice'],2),1,1);   
                            }
                        }
                    }
                    
                }
            }
             
        }
        else{
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(0,8,"No Record Found",0,'C');
            //$pdf->Cell(0,8,$to_date,1,0,'C');
            
        }
//cho $to_date;
//echo $from_date;
}

$pdf->Output();
?>

