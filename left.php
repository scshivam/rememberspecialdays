<?php
echo '<div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">';
$query="Select * from left_pannel";
$result=mysqli_query($connection,$query)or die(mysqli_error($connection));
while($row=mysqli_fetch_assoc($result))
{
	echo '<li>
                        <a href="'.$row['link'].'"><i class="'.$row['icon'].'"></i>'.' '.$row['option'].'</a>
                    </li>';
}
echo '</ul>
            </div>';
			?>