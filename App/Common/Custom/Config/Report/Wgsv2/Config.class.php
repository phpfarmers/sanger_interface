<?php
namespace Common\Custom\Config\Report\Wgsv2;
class Config extends \Common\Custom\Config\Report\BaseConfig
{
    const k = 1000;
    const M = 1000000;
    
    /**
     * 获取配置数据
     *
     * @return   array
     **/
    static public function config()
    {
        $config = parent::getConfig();
        $config = array_merge($config, self::getConfig());

        return array_merge($config, self::getControllerConfig());
    }

    /**
     * 获取当前配置数据
     *
     * @return   array
     **/
    static public function getConfig()
    {
        return array(
            'graphic_types' => array(
                'bar_error',
                'bar_line',
                'negative_bar',
                'bar',
                'curve',
                'manhattan_line',
                'multi_area',
                'circos',
                'browser',
                'distribution',
                'heatmap',
                'venn',
                'structure',
                'seq',
            ),
//             'snp_call' => array(
//                 // 验证数据
//                 'vertify_data' => array(
//                     // 标记深度筛选
//                     'mark_deep' => array('class' => 'mark_deep', 'type' => 'int'),
//                 ),
//             ),
            'bar_color_scheme' => array(
                1=> array('id' => 1, 'name' => '方案1', 'colors' => array('#1b9e77','#1f78b4','#33a02c','#e31a1c','#ff7f00','#6a3d9a','#b15928','#1776b6','#ff7f00','#24a121','#d8241f','#9564bf','#e574c3','#bcbf00','#7f7f7f','#00bed0','#666666','#fdc086','#beaed4','#7fc97f','#1b9e77','#a6cee3','#b2df8a','#fb9a99','#fdbf6f','#cab2d6','#ffff99')),
                2=> array('id' => 2, 'name' => '方案2', 'colors' => array("#CCFF99", "#FF6600", "#009900", "#FFD333", "#3DB8FF", "#3491CF", "#F8F8AB", "#A4C1F4", "#98F1EF", "#F8CFBF", "#F8CFBF", "#C8C7CC", "#2196F3", "#31a354", "#F44336","#8BC34A", "#E91E63", "#D32F2F", "#F8BBD0", "darkseagreen", "#FFEB3B", "#673AB7", "#C2185B", "#0288D1", "#CDDC39", "#3F51B5", "#393b79")),
                3=> array('id' => 3, 'name' => '方案3', 'colors' => array("#FF0000", "#FFA500","#FFD333","#FFFF00","#F0E68C","#F8F8AB", "#31a354","#00FF00","#009900","#00FFFF","#2196F3", "#3A5FCD","#673AB7", "#7b4173")),
                4=> array('id' => 4, 'name' => '方案4', 'colors' => array("lightsteelblue", "linen", "cornflowerblue", "indianred", "mediumorchid", "mediumseagreen", "mediumslateblue", "mediumturquoise", "teal", "sandybrown", "olivedrab")),
                5=> array('id' => 5, 'name' => '方案5', 'colors' => array("#FFD700", "#FFC0CB", "#FF83FA", "#FF6A6A", "#F0E68C", "#DDA0DD", "#C6E2FF", "#E6E6FA", "#FFB90F", "#63B8FF", "#EEE685")),
                6=> array('id' => 6, 'name' => '方案6', 'colors' => array("#00868B", "#27408B", "#473C8B", "#515151","#228B22","#8DB6CD", "#0000CD","#8B2252", "#0288D1", "#8E388E", "#2196F3", "#3A5FCD", "#2E8B57", "#673AB7", "#912CEE", "#8B6914", "#8E388E", "#009688", "#3F51B5")),
                7=> array('id' => 7, 'name' => '方案7', 'colors' => array("red", "purple", "green", "blue", "magenta", "#7b4173", " #bcbd22", "#8c564b", "#ff7f0e", "#843c39")),
            ),
            
            'boxplot_color_scheme' => array(
                1=> array('id' => 1, 'name' => '方案1', 'colors' => array('#1b9e77','#1f78b4','#33a02c','#e31a1c','#ff7f00','#6a3d9a','#b15928','#1776b6','#ff7f00','#24a121','#d8241f','#9564bf','#e574c3','#bcbf00','#7f7f7f','#00bed0','#666666','#fdc086','#beaed4','#7fc97f','#1b9e77','#a6cee3','#b2df8a','#fb9a99','#fdbf6f','#cab2d6','#ffff99')),
                2=> array('id' => 2, 'name' => '方案2', 'colors' => array("#CCFF99", "#FF6600", "#009900", "#FFD333", "#3DB8FF", "#3491CF", "#F8F8AB", "#A4C1F4", "#98F1EF", "#F8CFBF", "#F8CFBF", "#C8C7CC", "#2196F3", "#31a354", "#F44336","#8BC34A", "#E91E63", "#D32F2F", "#F8BBD0", "darkseagreen", "#FFEB3B", "#673AB7", "#C2185B", "#0288D1", "#CDDC39", "#3F51B5", "#393b79")),
                3=> array('id' => 3, 'name' => '方案3', 'colors' => array("#FF0000", "#FFA500","#FFD333","#FFFF00","#F0E68C","#F8F8AB", "#31a354","#00FF00","#009900","#00FFFF","#2196F3", "#3A5FCD","#673AB7", "#7b4173")),
                4=> array('id' => 4, 'name' => '方案4', 'colors' => array("lightsteelblue", "linen", "cornflowerblue", "indianred", "mediumorchid", "mediumseagreen", "mediumslateblue", "mediumturquoise", "teal", "sandybrown", "olivedrab")),
                5=> array('id' => 5, 'name' => '方案5', 'colors' => array("#FFD700", "#FFC0CB", "#FF83FA", "#FF6A6A", "#F0E68C", "#DDA0DD", "#C6E2FF", "#E6E6FA", "#FFB90F", "#63B8FF", "#EEE685")),
                6=> array('id' => 6, 'name' => '方案6', 'colors' => array("#00868B", "#27408B", "#473C8B", "#515151","#228B22","#8DB6CD", "#0000CD","#8B2252", "#0288D1", "#8E388E", "#2196F3", "#3A5FCD", "#2E8B57", "#673AB7", "#912CEE", "#8B6914", "#8E388E", "#009688", "#3F51B5")),
                7=> array('id' => 7, 'name' => '方案7', 'colors' => array("red", "purple", "green", "blue", "magenta", "#7b4173", " #bcbd22", "#8c564b", "#ff7f0e", "#843c39")),
            ),
            'manhattan_color_scheme' => array(
                1=> array('id' => 1, 'name' => '方案1', 'colors' => array('#1b9e77','#1f78b4','#33a02c','#e31a1c','#ff7f00','#6a3d9a','#b15928','#1776b6','#ff7f00','#24a121','#d8241f','#9564bf','#e574c3','#bcbf00','#7f7f7f','#00bed0','#666666','#fdc086','#beaed4','#7fc97f','#1b9e77','#a6cee3','#b2df8a','#fb9a99','#fdbf6f','#cab2d6','#ffff99')),
                2=> array('id' => 2, 'name' => '方案2', 'colors' => array("#CCFF99", "#FF6600", "#009900", "#FFD333", "#3DB8FF", "#3491CF", "#F8F8AB", "#A4C1F4", "#98F1EF", "#F8CFBF", "#F8CFBF", "#C8C7CC", "#2196F3", "#31a354", "#F44336","#8BC34A", "#E91E63", "#D32F2F", "#F8BBD0", "darkseagreen", "#FFEB3B", "#673AB7", "#C2185B", "#0288D1", "#CDDC39", "#3F51B5", "#393b79")),
                3=> array('id' => 3, 'name' => '方案3', 'colors' => array("#FF0000", "#FFA500","#FFD333","#FFFF00","#F0E68C","#F8F8AB", "#31a354","#00FF00","#009900","#00FFFF","#2196F3", "#3A5FCD","#673AB7", "#7b4173")),
                4=> array('id' => 4, 'name' => '方案4', 'colors' => array("lightsteelblue", "linen", "cornflowerblue", "indianred", "mediumorchid", "mediumseagreen", "mediumslateblue", "mediumturquoise", "teal", "sandybrown", "olivedrab")),
                5=> array('id' => 5, 'name' => '方案5', 'colors' => array("#FFD700", "#FFC0CB", "#FF83FA", "#FF6A6A", "#F0E68C", "#DDA0DD", "#C6E2FF", "#E6E6FA", "#FFB90F", "#63B8FF", "#EEE685")),
                6=> array('id' => 6, 'name' => '方案6', 'colors' => array("#00868B", "#27408B", "#473C8B", "#515151","#228B22","#8DB6CD", "#0000CD","#8B2252", "#0288D1", "#8E388E", "#2196F3", "#3A5FCD", "#2E8B57", "#673AB7", "#912CEE", "#8B6914", "#8E388E", "#009688", "#3F51B5")),
                7=> array('id' => 7, 'name' => '方案7', 'colors' => array("red", "purple", "green", "blue", "magenta", "#7b4173", " #bcbd22", "#8c564b", "#ff7f0e", "#843c39")),
            ),
            
            'distribution_color_scheme' => array(
                1=> array('id' => 1, 'name' => '方案1', 'color' => 1),
                2=> array('id' => 2, 'name' => '方案2', 'color' => 2),
                3=> array('id' => 3, 'name' => '方案3', 'color' => 3),
                4=> array('id' => 4, 'name' => '方案4', 'color' => 4),
                5=> array('id' => 5, 'name' => '方案5', 'color' => 5),
            ),
            
            'distribution2_color_scheme' => array(
                1=> array('id' => 1, 'name' => '方案1', 'colors' => array('#000000','#000000','#000000','#000000','#000000','#000000','#000000','#000000','#000000','#000000','#000000','#000000','#000000','#000000','#000000','#000000','#000000','#000000','#000000','#000000','#000000','#000000','#000000','#000000','#000000','#000000','#000000','#000000','#000000','#000000','#000000','#000000','#000000','#000000','#000000')),
                2=> array('id' => 2, 'name' => '方案2', 'colors' => array("#CCFF99", "#FF6600", "#009900", "#FFD333", "#3DB8FF", "#3491CF", "#F8F8AB", "#A4C1F4", "#98F1EF", "#F8CFBF", "#F8CFBF", "#C8C7CC", "#2196F3", "#31a354", "#F44336","#8BC34A", "#E91E63", "#D32F2F", "#F8BBD0", "darkseagreen", "#FFEB3B", "#673AB7", "#C2185B", "#0288D1", "#CDDC39", "#3F51B5", "#393b79",'#7fc97f','#1b9e77','#a6cee3','#b2df8a','#fb9a99','#fdbf6f','#cab2d6','#ffff99')),
                3=> array('id' => 3, 'name' => '方案3', 'colors' => array("#FF0000", "#FFA500","#FFD333","#FFFF00","#F0E68C","#F8F8AB", "#31a354","#00FF00","#009900","#00FFFF","#2196F3", "#3A5FCD","#673AB7", "#7b4173",'#7fc97f','#1b9e77','#a6cee3','#b2df8a','#fb9a99','#fdbf6f','#cab2d6','#ffff99')),
                4=> array('id' => 4, 'name' => '方案4', 'colors' => array("lightsteelblue", "linen", "cornflowerblue", "indianred", "mediumorchid", "mediumseagreen", "mediumslateblue", "mediumturquoise", "teal", "sandybrown", "olivedrab",'#7fc97f','#1b9e77','#a6cee3','#b2df8a','#fb9a99','#fdbf6f','#cab2d6','#ffff99')),
                5=> array('id' => 5, 'name' => '方案5', 'colors' => array("#FFD700", "#FFC0CB", "#FF83FA", "#FF6A6A", "#F0E68C", "#DDA0DD", "#C6E2FF", "#E6E6FA", "#FFB90F", "#63B8FF", "#EEE685",'#7fc97f','#1b9e77','#a6cee3','#b2df8a','#fb9a99','#fdbf6f','#cab2d6','#ffff99')),
                6=> array('id' => 6, 'name' => '方案6', 'colors' => array("#00868B", "#27408B", "#473C8B", "#515151","#228B22","#8DB6CD", "#0000CD","#8B2252", "#0288D1", "#8E388E", "#2196F3", "#3A5FCD", "#2E8B57", "#673AB7", "#912CEE", "#8B6914", "#8E388E", "#009688", "#3F51B5",'#7fc97f','#1b9e77','#a6cee3','#b2df8a','#fb9a99','#fdbf6f','#cab2d6','#ffff99')),
                7=> array('id' => 7, 'name' => '方案7', 'colors' => array("red", "purple", "green", "blue", "magenta", "#7b4173", " #bcbd22", "#8c564b", "#ff7f0e", "#843c39",'#7fc97f','#1b9e77','#a6cee3','#b2df8a','#fb9a99','#fdbf6f','#cab2d6','#ffff99','#7fc97f','#1b9e77','#a6cee3','#b2df8a','#fb9a99','#fdbf6f','#cab2d6','#ffff99')),
            ),
            'scatter_color_scheme' => array(
                1=> array('id' => 1, 'name' => '方案1', 'colors' => array('#1b9e77','#1f78b4','#33a02c','#e31a1c','#ff7f00','#6a3d9a','#b15928','#1776b6','#ff7f00','#24a121','#d8241f','#9564bf','#e574c3','#bcbf00','#7f7f7f','#00bed0','#666666','#fdc086','#beaed4','#7fc97f','#1b9e77','#a6cee3','#b2df8a','#fb9a99','#fdbf6f','#cab2d6','#ffff99')),
                2=> array('id' => 2, 'name' => '方案2', 'colors' => array("#CCFF99", "#FF6600", "#009900", "#FFD333", "#3DB8FF", "#3491CF", "#F8F8AB", "#A4C1F4", "#98F1EF", "#F8CFBF", "#F8CFBF", "#C8C7CC", "#2196F3", "#31a354", "#F44336","#8BC34A", "#E91E63", "#D32F2F", "#F8BBD0", "darkseagreen", "#FFEB3B", "#673AB7", "#C2185B", "#0288D1", "#CDDC39", "#3F51B5", "#393b79")),
                3=> array('id' => 3, 'name' => '方案3', 'colors' => array("#FF0000", "#FFA500","#FFD333","#FFFF00","#F0E68C","#F8F8AB", "#31a354","#00FF00","#009900","#00FFFF","#2196F3", "#3A5FCD","#673AB7", "#7b4173")),
                4=> array('id' => 4, 'name' => '方案4', 'colors' => array("lightsteelblue", "linen", "cornflowerblue", "indianred", "mediumorchid", "mediumseagreen", "mediumslateblue", "mediumturquoise", "teal", "sandybrown", "olivedrab")),
                5=> array('id' => 5, 'name' => '方案5', 'colors' => array("#FFD700", "#FFC0CB", "#FF83FA", "#FF6A6A", "#F0E68C", "#DDA0DD", "#C6E2FF", "#E6E6FA", "#FFB90F", "#63B8FF", "#EEE685")),
                6=> array('id' => 6, 'name' => '方案6', 'colors' => array("#00868B", "#27408B", "#473C8B", "#515151","#228B22","#8DB6CD", "#0000CD","#8B2252", "#0288D1", "#8E388E", "#2196F3", "#3A5FCD", "#2E8B57", "#673AB7", "#912CEE", "#8B6914", "#8E388E", "#009688", "#3F51B5")),
                7=> array('id' => 7, 'name' => '方案7', 'colors' => array("red", "purple", "green", "blue", "magenta", "#7b4173", " #bcbd22", "#8c564b", "#ff7f0e", "#843c39")),
            ),
            'map_shape' => array(
                '1' => array('id' => '1' , 'name' => '圆' , 'val' => 'circle'),
                '2' => array('id' => '2' , 'name' => '三角' , 'val' => 'triangle-up'),
                '3' => array('id' => '3' , 'name' => '菱形' , 'val' => 'diamond'),
                '4' => array('id' => '4' , 'name' => '正方' , 'val' => 'square'),
                '5' => array('id' => '5' , 'name' => '加号' , 'val' => 'cross'),
                '6' => array('id' => '6' , 'name' => '倒三角' , 'val' => 'triangle-down'),
            ),
            
            'introduction' =>array(
                'specimen_qc' => array(
                    '质控软件：Fastp',
                ),  
                'mapping' => array(
                    '分析软件：bwa',
                ),
                'anno'=>array(
                    '0'=>'基因组注释(Genome annotation) 是利用生物信息学方法和工具，对基因组所有基因的生物学功能进行高通量注释，是当前功能基因组学研究的一个热点。',
                    '1'=>'在获得基因的序列结构后，我们希望进一步获得基因的功能信息，一般的分析方式是在已经公布的基因功能数据库中寻找高度同源的序列，利用Blast软件将基因序列和蛋白序列进行同源比对，确定基因的功能。',
                    '2'=>'NR：即非冗余蛋白质序列（Non redundant）数据库，是系统分析基因功能、联系基因组信息和功能信息的数据库。',
                    '3'=>'UniProt：是Universal Protein 的英文缩写，是信息最丰富、资源最广的蛋白质数据库。它由整合Swiss-Prot、TrEMBL和PIR-PSD三大数据库的数据而成。他的数据主要来自于基因组测序项目完成后，后续获得的蛋白质序列。它包含了大量来自文献的蛋白质的生物功能的信息。',
                    '4'=>'GO：基因本体（Gene Ontology）数据库，可以将基因按照它们参与的生物学过程、构成细胞的组分，实现的分子功能等进行分类。',
                    '5'=>'KEGG：即Kyoto Encyclopedia of Genes and Genomes，京都基因和基因组百科全（http://www.genome.jp/kegg/），是一个综合数据库，它们大致分为系统信息、基因组信息和化学信息三大类。KEGG的Pathway数据库整合了当前在分子互动网络（比如通道，联合体）的知识，一般使用率较高。',
                    '6'=>'EggNOG：即Evolutionary genealogy of genes: Non-supervised Orthologous Groups，对直系同源类群进行了功能描述和功能分类的注释；包含了1133个物种的直系同源类群，主要分析蛋白的直系同源，同时作功能注释。'
                ),
            ),
            'circos_color_scheme' => array(
                1 => array('id'=>1,'name'=>'方案1','colors'=>array('Oranges','#4caf50','#f44336','#666666','#d3d3d3')),
                2 => array('id'=>2,'name'=>'方案2','colors'=>array('Greys','#4caf50','#f44336','#2196F3','#63B8FF')),
                3 => array('id'=>3,'name'=>'方案3','colors'=>array('Reds','#4caf50','#FFFF00','#666666','#d3d3d3')),
                4 => array('id'=>4,'name'=>'方案4','colors'=>array('GnBu','#4caf50','#f44336','#666666','#d3d3d3')),
                5 => array('id'=>5,'name'=>'方案5','colors'=>array('PuBu','#4caf50','#f44336','#666666','#d3d3d3')),
                6 => array('id'=>6,'name'=>'方案6','colors'=>array('Purples','#4caf50','#f44336','#666666','#d3d3d3')),
                7 => array('id'=>7,'name'=>'方案7','colors'=>array('Blues','#4caf50','#f44336','#666666','#d3d3d3')),
            ),
            
            'heatmap_colors' => array(
                '1' => array('id' => '1' , 'name' => '绿-白-红' , 'val' =>'#008000,#FFFFFF,#FF0000' ),
                '2' => array('id' => '2' , 'name' => '蓝-白-红' , 'val' =>'#000080,#FFFFFF,#FF0000' ),
                '3' => array('id' => '3' , 'name' => '蓝-黄-红' , 'val' =>'#0000FF,#FFFF00,#FF0000' ),
                '4' => array('id' => '4' , 'name' => '青绿-黄-红' , 'val' =>'#2E8B57,#FFFF00,#FF0000' ),
                '5' => array('id' => '5' , 'name' => '白-深绿' , 'val' =>'#fffffb,#005831' ),
                '6' => array('id' => '6' , 'name' => '白-黑' , 'val' => '#FFFFFF,#130c0e'),
                '7' => array('id' => '7' , 'name' => '黑-红' , 'val' => '#1d1626,#FF3030'),
                '8' => array('id' => '8' , 'name' => '亮黄-红' , 'val' => '#FFFF00,#d71345'),
                '9' => array('id' => '9' , 'name' => '白-蓝' , 'val' => '#fffffb,#1976D2'),
                '10' => array('id' => '10' , 'name' => '灰-黑' , 'val' => '#C0C0C0,#130c0e'),
                '11' => array('id' => '11' , 'name' => '绿-蓝-红' , 'val' => '#008000,#00FFFF,#FF0000'),
                '12' => array('id' => '12' , 'name' => '绿-黄-红' , 'val' => '#008000,#FFFF00,#FF0000'),
                '13' => array('id' => '13' , 'name' => '蓝-白-黄' , 'val' => '#0000FF,#FFFFFF,#DAA520'),
                '14' => array('id' => '14' , 'name' => '黑-绿-红' , 'val' => '#130c0e,#1d953f,#ed1941'),
                '15' => array('id' => '15' , 'name' => '深蓝-白-火砖色' , 'val' => '#000080,#FFFFFF,#B22222'),
                '16' => array('id' => '16' , 'name' => '红-黑-绿' , 'val' => '#ff0000,#000000,#00ff00'),
            ),
            //各项配置
            'variant_types' => array(
                'snp' => array('id' => 'snp', 'name' => 'SNP'),
                'indel' => array('id' => 'indel', 'name' => 'Indel'),
            ),
            'all_variant_types' => array(
                'all' => array('id' => 'all', 'name' => 'Total'),
                'snp' => array('id' => 'snp', 'name' => 'SNP'),
                'indel' => array('id' => 'indel', 'name' => 'Indel'),
            ),
            'img_types' => array(
                '1' => array('id' => '1', 'name' => '累加图'),
                '2' => array('id' => '2', 'name' => '直方图'),
            ),
            'step_num' => array(
                '5'   => array('id' => 5*self::k,   'name' => '5k'),
                '10'  => array('id' => 10*self::k,  'name' => '10k', 'variant_is_default' => 1),
                '50'  => array('id' => 50*self::k,  'name' => '50k'),
                '100' => array('id' => 100*self::k, 'name' => '100k'),
                '200' => array('id' => 200*self::k, 'name' => '200k'),
                '500' => array('id' => 500*self::k, 'name' => '500k'),
            ),
            'step_num2' => array(
                '20'  => array('id' => 20*self::k,  'name' => '20k'),
                '100' => array('id' => 100*self::k, 'name' => '100k'),
                '500' => array('id' => 500*self::k, 'name' => '500k'),
                '2M'  => array('id' => 2*self::M,  'name' => '2M'),
                '10M' => array('id' => 10*self::M, 'name' => '10M'),
                '50M' => array('id' => 50*self::M, 'name' => '50M'),
            ),
            'marker_type' => array(
                'Gene'=>array('id'=>'Gene', 'name'=>'Gene', 'lowcase_id'=>'gene'),
                'SNP+InDel'=>array('id'=>'SNP+InDel', 'name'=>'SNP+InDel', 'lowcase_id'=>'snpplusindel'),
                'SNP'=>array('id'=>'SNP', 'name'=>'SNP', 'lowcase_id'=>'snp'),
                'InDel'=>array('id'=>'InDel', 'name'=>'InDel', 'lowcase_id'=>'indel'),
                'SV'=>array('id'=>'SV', 'name'=>'SV', 'lowcase_id'=>'sv'),
                'CNV'=>array('id'=>'CNV', 'name'=>'CNV', 'lowcase_id'=>'cnv'),
                'SSR'=>array('id'=>'SSR', 'name'=>'SSR', 'lowcase_id'=>'ssr')
            ),
            'graphic_style' => array(
                'histogram'=>array('id'=>'histogram', 'name'=>'柱形图'),
                'scatter'=>array('id'=>'scatter', 'name'=>'散点图'),
                'line'=>array('id'=>'line', 'name'=>'折线图'),
                'area'=>array('id'=>'area', 'name'=>'区域图'),
                'heatmap'=>array('id'=>'heatmap', 'name'=>'热图')
            ),
            'regionanno_variant' => array(
                'non_variant'   => array('id' => 'non_variant', 'name' => 'Non variant'),
                'high'          => array('id' => 'high', 'name' => 'High','checked' => 1),
                'moderate'      => array('id' => 'moderate', 'name' => 'Moderate','checked' => 1),
                'low'           => array('id' => 'low', 'name' => 'Low'),
                'modifier'      => array('id' => 'modifier', 'name' => 'Modifier'),
            ),
            'regionanno_data_type' => array(
                'nr'        => array('id' => 'nr', 'name' => 'NR', 'checked' => 1),
                'uniprot'   => array('id' => 'uniprot', 'name' => 'UniProt', 'checked' => 1),
                'go'        => array('id' => 'go', 'name' => 'GO'),
                'ko'        => array('id' => 'ko', 'name' => 'KEGG'),
                'egg'       => array('id' => 'egg', 'name' => 'EggNOG'),
                'pfam'      => array('id' => 'pfam', 'name' => 'Pfam'),
                'interpro'       => array('id' => 'interpro ', 'name' => 'InterPro'),
            ),
            //params 参数判断
            'api_request_params'=>array(
                // type:类型
                // name:名称
                // range:区间值              
                // nedd:是否必填，1必填，0选填
                // params:和别的参数存在依赖关系
                 'svcall'=>array(
                    'chongmingming_result'=>array('type'=>'string','name'=>'chongmingming_result','range'=>array(),'need'=>0),// 1:必填，0:选填
                    'task_id'=>array('type'=>'string','name'=>'task_id','range'=>array(),'need'=>1),// 1:必填，0:选填
                    'task_type'=>array('type'=>'int','name'=>'task_type','range'=>array(),'need'=>1),// 1:必填，0:选填
                    'submit_location'=>array('type'=>'string','name'=>'submit_location','range'=>array(),'need'=>1),// 1:必填，0:选填
                  ),
                 'cnvcall'=>array(
                    'chongmingming_result'=>array('type'=>'string','name'=>'chongmingming_result','range'=>array(),'need'=>0),// 1:必填，0:选填
                    'task_id'=>array('type'=>'string','name'=>'task_id','range'=>array(),'need'=>1),// 1:必填，0:选填
                    'task_type'=>array('type'=>'int','name'=>'task_type','range'=>array(),'need'=>1),// 1:必填，0:选填
                    'submit_location'=>array('type'=>'string','name'=>'submit_location','range'=>array(),'need'=>1),// 1:必填，0:选填
                 ),
                 'ssrmarker'=>array(
                    'chongmingming_result'=>array('type'=>'string','name'=>'chongmingming_result','range'=>array(),'need'=>0),// 1:必填，0:选填
                    'task_id'=>array('type'=>'string','name'=>'task_id','range'=>array(),'need'=>1),// 1:必填，0:选填
                    'task_type'=>array('type'=>'int','name'=>'task_type','range'=>array(),'need'=>1),// 1:必填，0:选填
                    'submit_location'=>array('type'=>'string','name'=>'submit_location','range'=>array(),'need'=>1),// 1:必填，0:选填
                 ),
                'variantcompare'=>array(
                    'variant_type'=>array('type'=>'string','name'=>'variant_type','range'=>array(),'need'=>1),// 1:必填，0:选填
                    'alle_number'=>array('type'=>'string','name'=>'alle_number','range'=>array(),'need'=>1),// 1:必填，0:选填
                    'eff_type'=>array('type'=>'string','name'=>'eff_type','range'=>array(),'need'=>1),// 1:必填，0:选填
                    'region_type'=>array('type'=>'string','name'=>'region_type','range'=>array(),'need'=>1),// 1:必填，0:选填
                    'region'=>array('type'=>'array','name'=>'region','range'=>array(),'need'=>1, 'param' => array('region_type')),// 1:必填，0:选填                   
                    'analysis_model'=>array('type'=>'string','name'=>'analysis_model','range'=>array(),'need'=>1),// 1:必填，0:选填
                    
                    'sample'=>array('type'=>'array','name'=>'sample','range'=>array(),'need'=>0),// 1:必填，0:选填
                    'marktype'=>array('type'=>'array','name'=>'marktype','range'=>array(),'need'=>0,'param' => array('sample')),// 1:必填，0:选填
                    'genotype'=>array('type'=>'array','name'=>'genotype','range'=>array(),'need'=>0,'param' => array('sample')),// 1:必填，0:选填
                    'dep'=>array('type'=>'array','name'=>'dep','range'=>array(),'need'=>0,'param' => array('sample')),// 1:必填，0:选填                   
                    //组
                    'group_id'=>array('type'=>'array','name'=>'group_id','range'=>array(),'need'=>0),// 1:必填，0:选填
                    'group_ids'=>array('type'=>'string','name'=>'group_ids','range'=>array(),'need'=>0,'param' => array('group_id')),// 1:必填，0:选填
                    'spe_str'=>array('type'=>'array','name'=>'spe_str','range'=>array(),'need'=>0,'param' => array('group_id')),// 1:必填，0:选填
                    'group_dict'=>array('type'=>'object','name'=>'group_dict','range'=>array(),'need'=>0,'param' => array('group_id')),// 1:必填，0:选填
                    'group_name'=>array('type'=>'array','name'=>'group_name','range'=>array(),'need'=>0,'param' => array('group_id')),// 1:必填，0:选填
                    'maf'=>array('type'=>'array','name'=>'maf','range'=>array(),'need'=>0,'param' => array('group_id')),// 1:必填，0:选填
                    'ad'=>array('type'=>'array','name'=>'ad','range'=>array(),'need'=>0,'param' => array('group_id')),// 1:必填，0:选填
                    'max_miss'=>array('type'=>'array','name'=>'max_miss','range'=>array(),'need'=>0,'param' => array('group_id')),// 1:必填，0:选填
                                      
                    'chongmingming_result'=>array('type'=>'string','name'=>'chongmingming_result','range'=>array(),'need'=>0),// 1:必填，0:选填
                    'task_id'=>array('type'=>'string','name'=>'task_id','range'=>array(),'need'=>1),// 1:必填，0:选填
                    'task_type'=>array('type'=>'int','name'=>'task_type','range'=>array(),'need'=>1),// 1:必填，0:选填
                    'submit_location'=>array('type'=>'string','name'=>'submit_location','range'=>array(),'need'=>1),// 1:必填，0:选填
                ),
                'svcompare'=>array(
                    'region_type'=>array('type'=>'string','name'=>'region_type','range'=>array(),'need'=>1),// 1:必填，0:选填
                    'region'=>array('type'=>'array','name'=>'region','range'=>array(),'need'=>1, 'param' => array('region_type')),// 1:必填，0:选填
                    'analysis_model'=>array('type'=>'string','name'=>'analysis_model','range'=>array(),'need'=>1),// 1:必填，0:选填
                    
                    'sample_info'=>array('type'=>'array','name'=>'sample_info','range'=>array(),'need'=>0),// 1:必填，0:选填
                    'compare_type'=>array('type'=>'array','name'=>'compare_type','range'=>array(),'need'=>0,'param' => array('sample_info')),// 1:必填，0:选填
                    'genotype'=>array('type'=>'array','name'=>'genotype','range'=>array(),'need'=>0,'param' => array('sample_info')),// 1:必填，0:选填
                    'depth'=>array('type'=>'array','name'=>'depth','range'=>array(),'need'=>0,'param' => array('sample_info')),// 1:必填，0:选填
                    
                    'chongmingming_result'=>array('type'=>'string','name'=>'chongmingming_result','range'=>array(),'need'=>0),// 1:必填，0:选填
                    'task_id'=>array('type'=>'string','name'=>'task_id','range'=>array(),'need'=>1),// 1:必填，0:选填
                    'task_type'=>array('type'=>'int','name'=>'task_type','range'=>array(),'need'=>1),// 1:必填，0:选填
                    'submit_location'=>array('type'=>'string','name'=>'submit_location','range'=>array(),'need'=>1),// 1:必填，0:选填
                ),
                'cnvcompare'=>array(
                    'region_type'=>array('type'=>'string','name'=>'region_type','range'=>array(),'need'=>1),// 1:必填，0:选填
                    'region'=>array('type'=>'array','name'=>'region','range'=>array(),'need'=>1, 'param' => array('region_type')),// 1:必填，0:选填
                    'analysis_model'=>array('type'=>'string','name'=>'analysis_model','range'=>array(),'need'=>1),// 1:必填，0:选填
                    
                    'sample'=>array('type'=>'array','name'=>'sample','range'=>array(),'need'=>0),// 1:必填，0:选填
                    'marktype'=>array('type'=>'array','name'=>'marktype','range'=>array(),'need'=>0,'param' => array('sample')),// 1:必填，0:选填
                    
                    'chongmingming_result'=>array('type'=>'string','name'=>'chongmingming_result','range'=>array(),'need'=>0),// 1:必填，0:选填
                    'task_id'=>array('type'=>'string','name'=>'task_id','range'=>array(),'need'=>1),// 1:必填，0:选填
                    'task_type'=>array('type'=>'int','name'=>'task_type','range'=>array(),'need'=>1),// 1:必填，0:选填
                    'submit_location'=>array('type'=>'string','name'=>'submit_location','range'=>array(),'need'=>1),// 1:必填，0:选填
                ),
                'ssrcompare'=>array(
                    'alle_number'=>array('type'=>'string','name'=>'alle_number','range'=>array(),'need'=>1),// 1:必填，0:选填
                    'region_type'=>array('type'=>'string','name'=>'region_type','range'=>array(),'need'=>1),// 1:必填，0:选填
                    'region'=>array('type'=>'array','name'=>'region','range'=>array(),'need'=>1, 'param' => array('region_type')),// 1:必填，0:选填
                    'analysis_model'=>array('type'=>'string','name'=>'analysis_model','range'=>array(),'need'=>1),// 1:必填，0:选填
                    
                    'sample_info'=>array('type'=>'array','name'=>'sample_info','range'=>array(),'need'=>0),// 1:必填，0:选填
                    'compare_type'=>array('type'=>'array','name'=>'compare_type','range'=>array(),'need'=>0,'param' => array('sample_info')),// 1:必填，0:选填
                    'sample_genotype'=>array('type'=>'array','name'=>'sample_genotype','range'=>array(),'need'=>0,'param' => array('sample_info')),// 1:必填，0:选填
                    'sample_depth'=>array('type'=>'array','name'=>'sample_depth','range'=>array(),'need'=>0,'param' => array('sample_info')),// 1:必填，0:选填
                    //组
                    'group_id'=>array('type'=>'array','name'=>'group_id','range'=>array(),'need'=>0),// 1:必填，0:选填
                    'group_ids'=>array('type'=>'string','name'=>'group_ids','range'=>array(),'need'=>0,'param' => array('group_id')),// 1:必填，0:选填
                    'spe_str'=>array('type'=>'array','name'=>'spe_str','range'=>array(),'need'=>0,'param' => array('group_id')),// 1:必填，0:选填
                    'group_dict'=>array('type'=>'object','name'=>'group_dict','range'=>array(),'need'=>0,'param' => array('group_id')),// 1:必填，0:选填
                    'group_name'=>array('type'=>'array','name'=>'group_name','range'=>array(),'need'=>0,'param' => array('group_id')),// 1:必填，0:选填
                    'group_maf'=>array('type'=>'array','name'=>'group_maf','range'=>array(),'need'=>0,'param' => array('group_id')),// 1:必填，0:选填
                    'group_depth'=>array('type'=>'array','name'=>'group_depth','range'=>array(),'need'=>0,'param' => array('group_id')),// 1:必填，0:选填
                    'group_miss'=>array('type'=>'array','name'=>'group_miss','range'=>array(),'need'=>0,'param' => array('group_id')),// 1:必填，0:选填
                    
                    'chongmingming_result'=>array('type'=>'string','name'=>'chongmingming_result','range'=>array(),'need'=>0),// 1:必填，0:选填
                    'task_id'=>array('type'=>'string','name'=>'task_id','range'=>array(),'need'=>1),// 1:必填，0:选填
                    'task_type'=>array('type'=>'int','name'=>'task_type','range'=>array(),'need'=>1),// 1:必填，0:选填
                    'submit_location'=>array('type'=>'string','name'=>'submit_location','range'=>array(),'need'=>1),// 1:必填，0:选填
                ),
                
                'regionanno'=>array(
                    'region_type'=>array('type'=>'string','name'=>'region_type','range'=>array(),'need'=>1),// 1:必填，0:选填
                    'region'=>array('type'=>'array','name'=>'region','range'=>array(),'need'=>1, 'param' => array('region_type')),// 1:必填，0:选填
                    'anno_id'=>array('type'=>'string','name'=>'anno_id','range'=>array(),'need'=>1),// 1:必填，0:选填
                
                    'chongmingming_result'=>array('type'=>'string','name'=>'chongmingming_result','range'=>array(),'need'=>0),// 1:必填，0:选填
                    'task_id'=>array('type'=>'string','name'=>'task_id','range'=>array(),'need'=>1),// 1:必填，0:选填
                    'task_type'=>array('type'=>'int','name'=>'task_type','range'=>array(),'need'=>1),// 1:必填，0:选填
                    'submit_location'=>array('type'=>'string','name'=>'submit_location','range'=>array(),'need'=>1),// 1:必填，0:选填
                ),
                
                'primer'=>array(
                    'data_type'=>array('type'=>'string','name'=>'data_type','range'=>array(),'need'=>1),// 1:必填，0:选填
                    'marker_detail'=>array('type'=>'array','name'=>'marker_detail','range'=>array(),'need'=>1, 'param' => array('data_type')),// 1:必填，0:选填
                    'marker_type'=>array('type'=>'string','name'=>'marker_type','range'=>array(),'need'=>1),// 1:必填，0:选填
                    'condition'=>array('type'=>'object','name'=>'condition','range'=>array(),'need'=>1, 'param' => array('marker_type')),// 1:必填，0:选填
                    
                    'chongmingming_result'=>array('type'=>'string','name'=>'chongmingming_result','range'=>array(),'need'=>0),// 1:必填，0:选填
                    'task_id'=>array('type'=>'string','name'=>'task_id','range'=>array(),'need'=>1),// 1:必填，0:选填
                    'task_type'=>array('type'=>'int','name'=>'task_type','range'=>array(),'need'=>1),// 1:必填，0:选填
                    'submit_location'=>array('type'=>'string','name'=>'submit_location','range'=>array(),'need'=>1),// 1:必填，0:选填
                ),

                'chromosomedistribution' => array(
                    'submit_location'=>array('type'=>'string','name'=>'submit_location','range'=>array(),'need'=>1),
                    'task_id'=>array('type'=>'string','name'=>'task_id','range'=>array(),'need'=>1),
                    'task_type'=>array('type'=>'int','name'=>'task_type','range'=>array(),'need'=>1),
                    'marker_type'=>array('type'=>'string','name'=>'marker_type','range'=>array(),'need'=>1),
                    'data_type'=>array('type'=>'string','name'=>'data_type','range'=>array(),'need'=>1),
                    'win_step'=>array('type'=>'string','name'=>'win_step','range'=>array(),'need'=>1),
                    'analysis_object'=>array('type'=>'string','name'=>'analysis_object','range'=>array(),'need'=>0),
                    'graphic_style'=>array('type'=>'string','name'=>'graphic_style','range'=>array(),'need'=>1),
                    'chongmingming_result'=>array('type'=>'string','name'=>'chongmingming_result','range'=>array(),'need'=>0)
                ),

                'circos' => array(
                    'submit_location'=>array('type'=>'string','name'=>'submit_location','range'=>array(),'need'=>1),
                    'task_id'=>array('type'=>'string','name'=>'task_id','range'=>array(),'need'=>1),
                    'task_type'=>array('type'=>'int','name'=>'task_type','range'=>array(),'need'=>1),
                    'chongmingming_result'=>array('type'=>'string','name'=>'chongmingming_result','range'=>array(),'need'=>0),
                    'chromosome'=>array('type'=>'string','name'=>'chromosome','range'=>array(),'need'=>1),
                    'color'=>array('type'=>'int','name'=>'color','range'=>array(),'need'=>1),
                    'color_type'=>array('type'=>'string','name'=>'color_type','range'=>array(),'need'=>1),
                    'variant'=>array('type'=>'array','name'=>'variant','range'=>array(),'need'=>1)
                ),

                'assembly' => array(
                    'samples'=>array('type'=>'string','name'=>'samples','range'=>array(),'need'=>1),
                    'poss'=>array('type'=>'string','name'=>'poss','range'=>array(),'need'=>1),
                    'posname'=>array('type'=>'string','name'=>'posname','range'=>array(),'need'=>1),
                    'unmapping'=>array('type'=>'string','name'=>'unmapping','range'=>array(),'need'=>1),
                    'task_id'=>array('type'=>'string','name'=>'task_id','range'=>array(),'need'=>1),
                    'task_type'=>array('type'=>'int','name'=>'task_type','range'=>array(),'need'=>1),
                    'chongmingming_result'=>array('type'=>'string','name'=>'chongmingming_result','range'=>array(),'need'=>0),
                    'submit_location'=>array('type'=>'string','name'=>'submit_location','range'=>array(),'need'=>1)
                ),

                'crispr' => array(
                    'task_id'=>array('type'=>'string','name'=>'task_id','range'=>array(),'need'=>1),
                    'task_type'=>array('type'=>'int','name'=>'task_type','range'=>array(),'need'=>1),
                    'wt'=>array('type'=>'string','name'=>'wt','range'=>array(),'need'=>1),
                    'bam_list'=>array('type'=>'array','name'=>'bam_list','range'=>array(),'need'=>1),
                    'region'=>array('type'=>'string','name'=>'region','range'=>array(),'need'=>1),
                    'submit_location'=>array('type'=>'string','name'=>'submit_location','range'=>array(),'need'=>1),
                    'chongmingming_result'=>array('type'=>'string','name'=>'chongmingming_result','range'=>array(),'need'=>0),
                    'gene_name'=>array('type'=>'string','name'=>'gene_name','range'=>array(),'need'=>1),
                    'sg_rna'=>array('type'=>'string','name'=>'sg_rna','range'=>array(),'need'=>1)
                ),

                'transgenosis' => array(
                    'submit_location'=>array('type'=>'string','name'=>'submit_location','range'=>array(),'need'=>1),
                    'task_id'=>array('type'=>'string','name'=>'task_id','range'=>array(),'need'=>1),
                    'task_type'=>array('type'=>'int','name'=>'task_type','range'=>array(),'need'=>1),
                    'chongmingming_result'=>array('type'=>'string','name'=>'chongmingming_result','range'=>array(),'need'=>0),
                    'sample'=>array('type'=>'string','name'=>'sample','range'=>array(),'need'=>1),
                    'insert_id'=>array('type'=>'string','name'=>'insert_id','range'=>array(),'need'=>1)
                ),
            ),
            //表字段列
            'specimen_columns' => array(
                array('field' => 'specimen_id', 'title' => 'Sample Initial Name', 'width' => 150),
                array('field' => 'specimen_name', 'title' => 'Sample Analysis Name', 'width' => 150),
                //                     array('field' => 'specimen_name', 'title' => 'Sample New Name', 'width' => 150),
//                 array('field' => 'desc', 'title' => 'description', 'width' => 150),
                array('field' => 'batch', 'title' => 'Batch', 'width' => 150),
                array('field' => 'library', 'title' => 'Library', 'width' => 150),
                array('field' => 'raw_data', 'title' => 'Raw Data File', 'width' => 180),
                array('field' => 'desc', 'title' => 'Note', 'width' => 150),
            ),
            'specimen_software_columns' => array(
                array('field' => 'item', 'title' => '分析项', 'width' => 150),
                array('field' => 'software_name', 'title' => '软件', 'width' => 100),
                array('field' => 'version', 'title' => '软件版本', 'width' => 100),
                array('field' => 'params', 'title' => '软件参数', 'width' => 200),
            ),
            'specimen_qc_columns' => array(
                array('field' => 'specimen_name', 'title' => 'Sample ID', 'width' => 110),
                array('field' => 'raw_reads', 'title' => 'Raw Reads', 'width' => 110),
                array('field' => 'raw_base', 'title' => 'Raw Bases (bp)', 'width' => 110),
                array('field' => 'raw_gc_rate', 'title' => 'Raw GC (%)', 'width' => 90),
                array('field' => 'raw_q30_rate', 'title' => 'Raw Q30 (%)', 'width' => 100),
                array('field' => 'clean_reads', 'title' => 'Clean Reads', 'width' => 100),
                array('field' => 'clean_base', 'title' => 'Clean Bases (bp)', 'width' => 120),
                array('field' => 'clean_gc_rate', 'title' => 'Clean GC (%)', 'width' => 100),
                array('field' => 'clean_q30_rate', 'title' => 'Clean Q30(%)', 'width' => 110),
            ),
            'mapping_detail_columns' => array(
                array('field' => 'specimen_name', 'title' => 'Sample ID', 'width' => 100),
                array('field' => 'mapped_ratio', 'title' => 'Mapped Ratio(%)', 'width' => 120),
                array('field' => 'proper_ratio', 'title' => 'Proper Ratio(%)', 'width' => 120, 'sortable'=>false),
                array('field' => 'duplicate_ratio', 'title' => 'Duplicate Ratio(%)', 'width' => 125),
                array('field' => 'average_insert_size', 'title' => 'Average Insert Size', 'width' => 140),
                array('field' => 'average_depth', 'title' => 'Average Depth', 'width' => 125),
                array('field' => 'real_depth', 'title' => 'Real Depth', 'width' => 90),
                array('field' => 'genome_cov1', 'title' => 'Genome Coverage(1X)(%)', 'width' => 170),
                array('field' => 'genome_cov5', 'title' => 'Genome Coverage(5X)(%)', 'width' => 170),
            ),
            'variant_snp_stat_columns' => array(
                array('field' => 'specimen_name', 'title' => 'Sample ID', 'width' => 130),
                array('field' => 'number', 'title' => 'SNP Number', 'width' => 100),
                array('field' => 'transition', 'title' => 'Transition', 'width' => 100),
                array('field' => 'transversion', 'title' => 'Transversion', 'width' => 100),
                array('field' => 'ti_tv', 'title' => 'Ti/Tv', 'width' => 80),
                array('field' => 'hete_num', 'title' => 'Heterozygosity Number', 'width' => 180),
                array('field' => 'homo_num', 'title' => 'Homozygosity Number', 'width' => 180),
            ),
            'variant_indel_stat_columns' => array(
                array('field' => 'specimen_name', 'title' => 'Sample ID', 'width' => 130),
                array('field' => 'insert_num', 'title' => 'Insertion Number', 'width' => 130),
                array('field' => 'del_num', 'title' => 'Deletion Number', 'width' => 130),
                array('field' => 'hete_num', 'title' => 'Heterozygosity Number', 'width' => 160),
                array('field' => 'homo_num', 'title' => 'Homozygosity Number', 'width' => 160),
            ),
            
            //变异位点比较分析
            'variantcompare_columns' => array(
                array('field' => 'chr_id', 'title' => 'Chr ID', 'width' => 110),
                array('field' => 'snp_num', 'title' => 'SNP Number', 'width' => 110),
                array('field' => 'indel_num', 'title' => 'InDel Number', 'width' => 110),
                array('field' => 'total_num', 'title' => 'Total Number', 'width' => 110),
            ),
            
            'variantcompare_effect_columns' => array(
                array('field' => 'effect_type', 'title' => 'Impact Level', 'width' => 110),
                array('field' => 'snp_num', 'title' => 'SNP Number', 'width' => 110),
                array('field' => 'indel_num', 'title' => 'InDel Number', 'width' => 110),
                array('field' => 'total_num', 'title' => 'Total Number', 'width' => 110),
            ),
            
            'variantcompare_func_columns' => array(
                array('field' => 'func_type', 'title' => 'Effect Type', 'width' => 110),
                array('field' => 'snp_num', 'title' => 'SNP Number', 'width' => 110),
                array('field' => 'indel_num', 'title' => 'InDel Number', 'width' => 110),
                array('field' => 'total_num', 'title' => 'Total Number', 'width' => 110),
            ),
            
            'variantcompare_detail_columns' => array(
                array('field' => 'snp/indel_id', 'title' => 'SNP/InDel ID', 'width' => 110),
                array('field' => 'chr', 'title' => 'Chr', 'width' => 80),
                array('field' => 'pos', 'title' => 'Pos', 'width' => 80),
                array('field' => 'type', 'title' => 'Type', 'width' => 80),
                array('field' => 'ref', 'title' => 'Reference Genotype', 'width' => 110),
                array('field' => 'alt', 'title' => 'Alt', 'width' => 110),
            ),
            
            'svcompare_columns' => array(
            //                     array('field' => 'analysis_id', 'title' => 'Analysis ID', 'width' => 110),
                array('field' => 'chr', 'title' => 'Chr ID', 'width' => 110),
                array('field' => 'del', 'title' => 'DEL', 'width' => 110),
                array('field' => 'ins', 'title' => 'INS', 'width' => 110),
                array('field' => 'dup', 'title' => 'DUP', 'width' => 110),
                array('field' => 'inv', 'title' => 'INV', 'width' => 110),
                array('field' => 'bnd', 'title' => 'BND', 'width' => 110),
            ),
            'svcompare_detail_columns' => array(
                array('field' => 'sv_id', 'title' => 'SV ID', 'width' => 110),
                array('field' => 'chr', 'title' => 'Chr', 'width' => 110),
                array('field' => 'start', 'title' => 'Start', 'width' => 110),
                array('field' => 'end', 'title' => 'End', 'width' => 110),
                array('field' => 'len', 'title' => 'Length', 'width' => 110),
            ),
            
            'cnvcompare_columns' => array(
                array('field' => 'chr', 'title' => 'Chr ID', 'width' => 110),
                array('field' => 'del', 'title' => 'Deletion', 'width' => 110),
                array('field' => 'dup', 'title' => 'Duplication', 'width' => 110),
                array('field' => 'gene', 'title' => 'Gene', 'width' => 110),
            ),
            'cnvcompare_detail_columns' => array(
                array('field' => 'cnv_id', 'title' => 'CNV ID', 'width' => 110),
                array('field' => 'chr', 'title' => 'Chr', 'width' => 110),
                array('field' => 'start', 'title' => 'Start', 'width' => 110),
                array('field' => 'end', 'title' => 'End', 'width' => 110),
                array('field' => 'len', 'title' => 'Length', 'width' => 110),
            ),
            
            'ssrcompare_columns' => array(
                array('field' => 'chr', 'title' => 'Chr', 'width' => 110),
                array('field' => 'ssr_num', 'title' => 'SSR Number', 'width' => 110),
                array('field' => 'c', 'title' => 'c', 'width' => 110),
                array('field' => 'c_star', 'title' => 'c*', 'width' => 110),
                array('field' => 'p1', 'title' => 'p1', 'width' => 85),
                array('field' => 'p2', 'title' => 'p2', 'width' => 85),
                array('field' => 'p3', 'title' => 'p3', 'width' => 85),
                array('field' => 'p4', 'title' => 'p4', 'width' => 85),
                array('field' => 'p5', 'title' => 'p5', 'width' => 85),
                array('field' => 'p6', 'title' => 'p6', 'width' => 85),
            ),
            'ssrcompare_detail_columns' => array(
                array('field' => 'ssr_id', 'title' => 'SSR ID', 'width' => 110),
                array('field' => 'chr', 'title' => 'Chr', 'width' => 110),
                array('field' => 'start', 'title' => 'Start', 'width' => 110),
                array('field' => 'end', 'title' => 'End', 'width' => 110),
                array('field' => 'repeat_unit', 'title' => 'Repeat unit', 'width' => 110),
                array('field' => 'ref_count', 'title' => 'Reference Repeat count', 'width' => 110),
            ),              
            
            'regionanno_detail_columns' => array(
                array('field' => 'gene_name_id', 'title' => 'Gene ID: Gene Name', 'width' => 100, 'frozen_column'=>1),
                array('field' => 'transcrit_id', 'title' => 'Transcrit ID', 'width' => 80, 'frozen_column'=>1),
                array('field' => 'chr', 'title' => 'Chr', 'width' => 80),
                array('field' => 'start', 'title' => 'Start', 'width' => 80),
                array('field' => 'end', 'title' => 'End', 'width' => 80),
                array('field' => 'high', 'title' => 'High', 'width' => 80),
                array('field' => 'moderate', 'title' => 'Moderate', 'width' => 80),
                array('field' => 'low', 'title' => 'Low', 'width' => 80),
                array('field' => 'modifier', 'title' => 'Modifier', 'width' => 80),
            ),
            'regionanno_go_stat_columns' => array(
                array('field' => 'go_id', 'title' => 'GO ID', 'width' => 200),
                array('field' => 'des', 'title' => 'Description', 'width' => 200),
                array('field' => 'eff_variant', 'title' => 'Effection', 'width' => 200),
                array('field' => 'total_variant', 'title' => 'Total', 'width' => 100),
            ),
            'regionanno_kegg_stat_columns' => array(
                array('field' => 'ko_id', 'title' => 'ko ID', 'width' => 150),
                array('field' => 'des', 'title' => 'Description', 'width' => 250),
                array('field' => 'eff_variant', 'title' => 'Effection', 'width' => 100),
                array('field' => 'total_variant', 'title' => 'Total', 'width' => 150),
            ),
            'regionanno_egg_stat_columns' => array(
                array('field' => 'eggnog_id', 'title' => 'Functional Categories', 'width' => 450),
                array('field' => 'eff_variant', 'title' => 'Effection', 'width' => 100),
                array('field' => 'total_variant', 'title' => 'Total', 'width' => 100),
            ),
            'regionanno_pfam_stat_columns' => array(
                array('field' => 'pfam_acc', 'title' => 'Pfam Accession', 'width' => 300),
                array('field' => 'pfam_anno', 'title' => 'Pfam Annotation', 'width' => 450),
                array('field' => 'eff_variant', 'title' => 'Effection', 'width' => 100),
                array('field' => 'total_variant', 'title' => 'Total', 'width' => 100),
            ),
            
            'regionanno_gene_relation_columns' => array(
                array('field' => 'gene_id', 'title' => 'Gene ID', 'width' => 250),
                array('field' => 'gene_name', 'title' => 'Gene Name', 'width' => 270),
                array('field' => 'transcrit_id', 'title' => 'Transcript ID', 'width' => 250),
            ),
            
            'primer_detail_columns' => array(
                array('field' => 'type', 'title' => 'Type', 'width' => 100, 'frozen_column'=>1, 'sortable'=>true),
                array('field' => 'chr', 'title' => 'Chr', 'width' => 100, 'frozen_column'=>1, 'sortable'=>true),
                array('field' => 'pos', 'title' => 'Pos', 'width' => 100, 'frozen_column'=>1, 'sortable'=>true),

                array('field' => 'forward_primer1', 'title' => 'Forward Primer1 (5\'-3\')', 'width' => 170),
                array('field' => 'forward_tm1', 'title' => 'Tm (℃)', 'width' => 70),
                array('field' => 'forward_gc1', 'title' => 'GC (%)', 'width' => 70),
                array('field' => 'forward_len1', 'title' => 'Length (bp)', 'width' => 90),
                array('field' => 'reverse_primer1', 'title' => 'Reverse Primer1 (5\'-3\')', 'width' => 170),
                array('field' => 'reverse_tm1', 'title' => 'Tm (℃)', 'width' => 70),
                array('field' => 'reverse_gc1', 'title' => 'GC (%)', 'width' => 70),
                array('field' => 'reverse_len1', 'title' => 'Length (bp)', 'width' => 90),
                array('field' => 'product_size1', 'title' => 'Product Size1 (bp)', 'width' => 120),
                array('field' => 'start1', 'title' => 'Product1 Start(bp)', 'width' => 120),
                array('field' => 'end1', 'title' => 'Product1 End(bp)', 'width' => 120),

                array('field' => 'forward_primer2', 'title' => 'Forward Primer2 (5\'-3\')', 'width' => 170),
                array('field' => 'forward_tm2', 'title' => 'Tm (℃)', 'width' => 70),
                array('field' => 'forward_gc2', 'title' => 'GC (%)', 'width' => 70),
                array('field' => 'forward_len2', 'title' => 'Length (bp)', 'width' => 90),
                array('field' => 'reverse_primer2', 'title' => 'Reverse Primer2 (5\'-3\')', 'width' => 170),
                array('field' => 'reverse_tm2', 'title' => 'Tm (℃)', 'width' => 70),
                array('field' => 'reverse_gc2', 'title' => 'GC (%)', 'width' => 70),
                array('field' => 'reverse_len2', 'title' => 'Length (bp)', 'width' => 90),
                array('field' => 'product_size2', 'title' => 'Product Size2 (bp)', 'width' => 120),
                array('field' => 'start2', 'title' => 'Product2 Start(bp)', 'width' => 120),
                array('field' => 'end2', 'title' => 'Product2 End(bp)', 'width' => 120),

                array('field' => 'forward_primer3', 'title' => 'Forward Primer3 (5\'-3\')', 'width' => 170),
                array('field' => 'forward_tm3', 'title' => 'Tm (℃)', 'width' => 70),
                array('field' => 'forward_gc3', 'title' => 'GC (%)', 'width' => 70),
                array('field' => 'forward_len3', 'title' => 'Length (bp)', 'width' => 90),
                array('field' => 'reverse_primer3', 'title' => 'Reverse Primer3 (5\'-3\')', 'width' => 170),
                array('field' => 'reverse_tm3', 'title' => 'Tm (℃)', 'width' => 70),
                array('field' => 'reverse_gc3', 'title' => 'GC (%)', 'width' => 70),
                array('field' => 'reverse_len3', 'title' => 'Length (bp)', 'width' => 90),
                array('field' => 'product_size3', 'title' => 'Product Size3 (bp)', 'width' => 120),
                array('field' => 'start3', 'title' => 'Product3 Start(bp)', 'width' => 120),
                array('field' => 'end3', 'title' => 'Product3 End(bp)', 'width' => 120),
            ),
            
            //查看报告限制显示记录数
            'table_limit' => 7,
        );
    }
    /**
     * 控制器配置
     *
     * @return   array
     **/
    static private function getControllerConfig()
    {
        return array(
            'controller_config' => array(
                '\Report\Controller\Wgsv2\SpecimenController',
                '\Report\Controller\Wgsv2\MappingController',
                '\Report\Controller\Wgsv2\VariantCallController',
                '\Report\Controller\Wgsv2\VariantAnnoController',
                '\Report\Controller\Wgsv2\VariantCompareController',
                '\Report\Controller\Wgsv2\VariantCompareCollectController',
                '\Report\Controller\Wgsv2\SvCallController',
                '\Report\Controller\Wgsv2\SvCompareController',
                '\Report\Controller\Wgsv2\CnvCallController',
                '\Report\Controller\Wgsv2\CnvCompareController',
                '\Report\Controller\Wgsv2\SsrMarkerController',
                '\Report\Controller\Wgsv2\SsrCompareController',
                '\Report\Controller\Wgsv2\CompareController',
                '\Report\Controller\Wgsv2\RegionAnnoController',
                '\Report\Controller\Wgsv2\GeneController',
                '\Report\Controller\Wgsv2\PrimerController',


                '\Report\Controller\Wgsv2\ChromosomeDistributionController',
                '\Report\Controller\Wgsv2\CircosController',
                '\Report\Controller\Wgsv2\CrisprController',
                '\Report\Controller\Wgsv2\AssemblyController',
                '\Report\Controller\Wgsv2\TransgenosisController',
                '\Report\Controller\Wgsv2\UploadController',
                '\Report\Controller\Wgsv2\SeqController',
                '\Report\Controller\Wgsv2\DataStatController',
            ),
        );
    }

    /**
     * 获取当前模块mongo配置数据
     *
     * @return   array
     **/
    static public function getDbConfig()
    {
        return array(
            'online'    => array(
                'host'          => '1.1.1.1',
                'user_name'     => 'wgs_v2',
                'user_password' => 'aaaaa',
                'db_name'       => 'bbbbbb',
                'authMechanism' => 'SCRAM-SHA-1',
            ),
            'offline'   => array(
                'host'          => '1.1.1.1',
                'user_name'     => 'wgs_v2',
                'user_password' => 'aaaaa',
                'db_name'       => 'bbbbb',
                'authMechanism' => 'SCRAM-SHA-1',
            ),
        );
    }
}

