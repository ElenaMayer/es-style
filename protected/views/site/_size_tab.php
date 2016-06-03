<?php $this->beginWidget(
    'booster.widgets.TbModal',
    array('id' => 'size_tab')
); ?>

    <div class="modal-body">
        <a class="close" data-dismiss="modal">&times;</a>
        <h2 class="h2">Таблица соответствия размеров</h2>
        <table>
            <thead>
            <tr>
                <th colspan="11">Женская одежда</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th>Обхват груди (см)</th>
                <td>78-82</td>
                <td>82-86</td>
                <td>86-90</td>
                <td>90-94</td>
                <td>94-98</td>
                <td>98-102</td>
                <td>102-106</td>
                <td>106-110</td>
                <td>110-114</td>
                <td>114-118</td>
            </tr>
            <tr>
                <th>Обхват талии (см)</th>
                <td>58-62</td>
                <td>62-66</td>
                <td>66-70</td>
                <td>70-74</td>
                <td>74-78</td>
                <td>78-82</td>
                <td>82-86</td>
                <td>86-90</td>
                <td>90-94</td>
                <td>94-98</td>
            </tr>
            <tr>
                <th>Обхват бедер (см)</th>
                <td>82-86</td>
                <td>86-90</td>
                <td>90-94</td>
                <td>94-98</td>
                <td>98-102</td>
                <td>102-106</td>
                <td>106-110</td>
                <td>110-114</td>
                <td>114-118</td>
                <td>118-122</td>
            </tr>
            <tr class="size-tab__select">
                <th>Российский размер</th>
                <td>40</td>
                <td>42</td>
                <td>44</td>
                <td>46</td>
                <td>48</td>
                <td>50</td>
                <td>52</td>
                <td>54</td>
                <td>56</td>
                <td>58</td>
            </tr>
            <tr>
                <th>Международный</th>
                <td>S</td>
                <td>S/M</td>
                <td>M/L</td>
                <td>L/XL</td>
                <td>XL/2XL</td>
                <td>2XL/3XL</td>
                <td>3XL/4XL</td>
                <td>4XL</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            </tbody>
        </table>
    </div>

<?php $this->endWidget(); ?>

<script>
    if (<?= isset($_GET['size_tab']) ? 1 : 0;?> == 1)
        jQuery('#size_tab').modal('show');
</script>