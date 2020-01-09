<?php
namespace Common\Custom\Config\Report\Metag;
class Config extends \Common\Custom\Config\Report\BaseConfig
{
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
            'status'=>array(
                '1'=>array('name'=>'完成','val'=>'end'),
                '2'=>array('name'=>'计算中','val'=>'start'),
                '3'=>array('name'=>'失败','val'=>'failed'),
                ),
            'assemble_stat_step' => array(
                '1' => array('id' => '200', 'val' => '200'),
                '2' => array('id' => '400', 'val' => '400'),
                '3' => array('id' => '500', 'val' => '500'),
                '4' => array('id' => '600', 'val' => '600'),
                '5' => array('id' => '800', 'val' => '800'),
                '6' => array('id' => '1000', 'val' => '1000'),
                '7' => array('id' => '1500', 'val' => '1500'),
                '8' => array('id' => '2000', 'val' => '2000'),
                '9' => array('id' => '3000', 'val' => '3000'),
            ),
            'predict_gene_step' => array(
                '1' => array('id' => '200', 'val' => '200'),
                '2' => array('id' => '400', 'val' => '400'),
                '3' => array('id' => '500', 'val' => '500'),
                '4' => array('id' => '600', 'val' => '600'),
                '5' => array('id' => '800', 'val' => '800'),
            ),
            //颜色分组方案
            'select_colors' => array(
                '1' => array('id' => '1' , 'name' => '绿色' , 'val' => '#388E3C','en_name'=>'green'),
                '2' => array('id' => '2' , 'name' => '红色' , 'val' => '#F44336','en_name'=>'red'),
                '3' => array('id' => '3' , 'name' => '蓝色' , 'val' => '#0288D1','en_name'=>'blue'),
                '4' => array('id' => '4' , 'name' => '黄色' , 'val' => '#FF9800','en_name'=>'yellow'),
                '5' => array('id' => '5' , 'name' => '黑色' , 'val' => '#212121','en_name'=>'black'),
                '6' => array('id' => '6' , 'name' => '粉色' , 'val' => '#E91E63','en_name'=>'pink'),         
                '7' => array('id' => '7' , 'name' => '紫色' , 'val' => '#673AB7','en_name'=>'purple'),
                '8' => array('id' => '8' , 'name' => '深绿' , 'val' => '#006400','en_name'=>'deep green'),
                '9' => array('id' => '9' , 'name' => '橙色' , 'val' => '#FFA500','en_name'=>'orange'),
                '10' => array('id' => '10' , 'name' => '纯红' , 'val' => '#FF0000','en_name'=>'pure red'),
                '11' => array('id' => '11' , 'name' => '深红' , 'val' => '#8B0000','en_name'=>'dark red'),
                '12' => array('id' => '12' , 'name' => '灰色' , 'val' => '#808080','en_name'=>'gray'),
                '13' => array('id' => '13' , 'name' => '银白' , 'val' => '#C0C0C0','en_name'=>'silver white'),
                '14' => array('id' => '14' , 'name' => '淡绿' , 'val' => '#90EE90','en_name'=>'light green'),
                '15' => array('id' => '15' , 'name' => '碧绿' , 'val' => '#7FFFAA','en_name'=>'aquamarine'),
                '16' => array('id' => '16' , 'name' => '深粉' , 'val' => '#FF1493','en_name'=>'deep pink'),
                '17' => array('id' => '17' , 'name' => '粉红' , 'val' => '#FFC0CB','en_name'=>'rose bloom'),
                '18' => array('id' => '18' , 'name' => '洋红' , 'val' => '#FF00FF','en_name'=>'magenta'),
                '19' => array('id' => '19' , 'name' => '淡蓝' , 'val' =>'#ADD8E6','en_name'=>'light blue'),
                '20' => array('id' => '20' , 'name' => '天蓝' , 'val' => '#87CEEB','en_name'=>'sky blue'), 
            ),
            'colors'   => array(
                '1' => array('id' => 1, 'name' => '方案A', 'val' => '#45AFE2'),
                '2' => array('id' => 2, 'name' => '方案B', 'val' => '#DF51FD'),
                '3' => array('id' => 3, 'name' => '方案C', 'val' => '#DB6651'),
                '4' => array('id' => 4, 'name' => '方案D', 'val' => '#E9E91F'),
            ),
            'atgcn_config' => array(
                '1' => array('id' => '1', 'title'=>'A'),
                '2' => array('id' => '2', 'title'=>'T'),
                '3' => array('id' => '3', 'title'=>'G'),
                '4' => array('id' => '4', 'title'=>'C'),
                '5' => array('id' => '5', 'title'=>'N'),
            ),
            //热图颜色主题
            'heatmap_colors' => array(//#00ff7f
                '1' => array('id' => '1' , 'name' => '绿-白-红' , 'val' =>'#008000,#FFFFFF,#FF0000' ,'en_name'=>'green-white-red'),
                '2' => array('id' => '2' , 'name' => '蓝-白-红' , 'val' =>'#000080,#FFFFFF,#FF0000' ,'en_name'=>'blue-white-red'),
                '3' => array('id' => '3' , 'name' => '蓝-黄-红' , 'val' =>'#0000FF,#FFFF00,#FF0000' ,'en_name'=>'blue-yellow-red'),
                '4' => array('id' => '4' , 'name' => '青绿-黄-红' , 'val' =>'#2E8B57,#FFFF00,#FF0000' ,'en_name'=>'green-yellow-red'),
                '5' => array('id' => '5' , 'name' => '白-深绿' , 'val' =>'#fffffb,#005831' ,'en_name'=>'white-dark green'),
                '6' => array('id' => '6' , 'name' => '白-黑' , 'val' => '#FFFFFF,#130c0e','en_name'=>'white-black'),
                '7' => array('id' => '7' , 'name' => '黑-红' , 'val' => '#1d1626,#FF3030','en_name'=>'black-red'),
                '8' => array('id' => '8' , 'name' => '亮黄-红' , 'val' => '#FFFF00,#d71345','en_name'=>'brilliant yellow-red'),
                '9' => array('id' => '9' , 'name' => '白-蓝' , 'val' => '#fffffb,#1976D2','en_name'=>'white-blue'), 
                '10' => array('id' => '10' , 'name' => '灰-黑' , 'val' => '#C0C0C0,#130c0e','en_name'=>'gray-black'), 
                '11' => array('id' => '11' , 'name' => '绿-蓝-红' , 'val' => '#008000,#00FFFF,#FF0000','en_name'=>'green-blue-red'),
                '12' => array('id' => '12' , 'name' => '绿-黄-红' , 'val' => '#008000,#FFFF00,#FF0000','en_name'=>'green-yellow-red'),
                '13' => array('id' => '13' , 'name' => '蓝-白-黄' , 'val' => '#0000FF,#FFFFFF,#DAA520','en_name'=>'blue-white-yellow'),
                '14' => array('id' => '14' , 'name' => '黑-绿-红' , 'val' => '#130c0e,#1d953f,#ed1941','en_name'=>'black-green-red'),
                //'15' => array('id' => '15' , 'name' => '蓝-绿-黄-红' , 'val' => '#0611ef,#06c0ef,#06ef4a,#efe706,#ef062e'),
                '16' => array('id' => '16' , 'name' => '深蓝-白-火砖色' , 'val' => '#000080,#FFFFFF,#B22222','en_name'=>'dark blue-white-dark red'),
                '17' => array('id' => '17' , 'name' => '红-黑-绿' , 'val' => '#ff0000,#000000,#00ff00','en_name'=>'red-blue-green'),
                //'18' => array('id' => '18' , 'name' => '浅蓝-黄-红' , 'val' => '#5883BB,#ffffff,#FEEFA6,#DB3D2F'),
                //'19' => array('id' => '19' , 'name' => '蓝-绿-黄-橙' , 'val' => '#131DCC,#51FF25,#FFFF00,#FF1311'),
            ),
            'color_schemes' =>array(
                '1' =>array('id'=>'1','en_name'=>'Nature Reviews Cancer','name'=>'Nature经典配色','val'=>'#E64B35,#4DBBD5,#00A087,#3C5488,#F39B7F,#8491B4,#91D1C2,#DC0000,#7E6148,#B09C85'),
                '2' =>array('id'=>'2','en_name'=>'Science from AAAS','name'=>'SCI经典配色','val'=>'#3B4992,#EE0000,#008B45,#631879,#008280,#BB0021,#5F559B,#A20056,#808180,#1B1919'),
                '3' =>array('id'=>'3','en_name'=>'IGV','name'=>'IGV','val'=>'#5050FF,#CE3D32,#749B58,#F0E685,#466983,#BA6338,#5DB1DD,#802268,#6BD76B,#D595A7,#924822,#837B8D,#C75127,#D58F5C,#7A65A5,#E4AF69,#3B1B53,#CDDEB7,#612A79,#AE1F63,#E7C76F,#5A655E,#CC9900,#99CC00,#A9A9A9,#CC9900,#99CC00,#33CC00,#00CC33,#00CC99,#0099CC,#0A47FF,#4775FF,#FFC20A,#FFD147,#990033,#991A00,#996600,#809900,#339900,#00991A,#009966,#008099,#003399,#1A0099,#660099,#990080,#D60047,#FF1463,#00D68F,#14FFB1'),
                '4' =>array('id'=>'4','en_name'=>'Lancet Oncology','name'=>'Lancet Oncology','val'=>'#00468B,#ED0000,#42B540,#0099B4,#925E9F,#FDAF91,#AD002A,#ADB6B6,#1B1919'),
                '5' =>array('id'=>'5','en_name'=>'The New England Journal of Medicine','name'=>'The New England Journal of Medicine','val'=>'#BC3C29,#0072B5,#E18727,#20854E,#7876B1,#6F99AD,#FFDC91,#EE4C97'),
                '6' =>array('id'=>'6','en_name'=>'The Journal of the American Medical Association','name'=>'The Journal of the American Medical Association','val'=>'#374E55,#DF8F44,#00A1D5,#B24745,#79AF97,#6A6599,#80796B'),
                '7' =>array('id'=>'7','en_name'=>'custom','name'=>'自定义配色','val'=>''),
                ),
            'method' => array(
                '1' => array('id' => '1', 'name'=>'Reads Number','value'=>"reads_num"),
                '2' => array('id' => '2', 'name'=>'Reads Number_Relative','value'=>"reads_num_relative"),
                '3' => array('id' => '3', 'name'=>'Reads Number/Gene Length','value'=>"reads_genelen_ratio"),
                '4' => array('id' => '4', 'name'=>'Reads Number/Gene Length_Relative','value'=>"reads_genelen_ratio_relative"),
                '5' => array('id' => '5', 'name'=>'RPKM','value'=>"rpkm"),
                '6' => array('id' => '6', 'name'=>'TPM','value'=>"tpm"),
                '7' => array('id' => '7', 'name'=>'PPM','value'=>"ppm"),
               
            ),
            //距离算法
            'distance_method'=>array(
                '1'   => array('id' => '1', 'name' => 'abund_jaccard'),
                '2'   => array('id' => '2', 'name' => 'binary_chisq'),
                '3'   => array('id' => '3', 'name' => 'binary_chord'),
                '4'   => array('id' => '4', 'name' => 'binary_euclidean'),
                '5'   => array('id' => '5', 'name' => 'binary_hamming'),
                '6'   => array('id' => '6', 'name' => 'binary_jaccard'),
                '7'   => array('id' => '7', 'name' => 'binary_lennon'),
                '8'   => array('id' => '8', 'name' => 'binary_ochiai'),
                '9'   => array('id' => '9', 'name' => 'binary_pearson'),
                '10'  => array('id' => '10', 'name' => 'binary_sorensen_dice'),
                '11'  => array('id' => '11', 'name' => 'bray_curtis'),
                '12'  => array('id' => '12', 'name' => 'bray_curtis_faith'),
                '13'  => array('id' => '13', 'name' => 'bray_curtis_magurran'),
                '14'  => array('id' => '14', 'name' => 'canberra'),
                '15'  => array('id' => '15', 'name' => 'chisq'),
                '16'  => array('id' => '16', 'name' => 'chord'),
                '17'  => array('id' => '17', 'name' => 'euclidean'),
                '18'  => array('id' => '18', 'name' => 'gower'),
                '19'  => array('id' => '19', 'name' => 'hellinger'),
                '20'  => array('id' => '20', 'name' => 'kulczynski'),
                '21'  => array('id' => '21', 'name' => 'manhattan'),
                '22'  => array('id' => '22', 'name' => 'morisita_horn'),
                '23'  => array('id' => '23', 'name' => 'pearson'),
                '24'  => array('id' => '24', 'name' => 'soergel'),
                '25'  => array('id' => '25', 'name' => 'spearman_approx'),
                '26'  => array('id' => '26', 'name' => 'specprof'),
            ),
            //分组样本计算
            'group_method' => array(
                '1' => array('id' => '1', 'name'=>'无','value'=>"",'en_name'=>'None' ),
                '2' => array('id' => '2', 'name'=>'求和','value'=>"sum",'en_name'=>'Sum' ),
                '3' => array('id' => '3', 'name'=>'求均值','value'=>"average",'en_name'=>'Average'),
                '4' => array('id' => '4', 'name'=>'中位数','value'=>"middle",'en_name'=>'Median'),
            ),
            //柱形图颜色分组方案
            'bar_group_color' => array(
                '1' => array('id' => '1','en_name'=>'Theme A' ,'name'=>'方案一','value'=>array("#0000FF", "#006400", "#FF0000", "#8A2BE2", "#00F5FF", "#458B00", "#FFFF00", "#FF4500", "#00FF7F", "#FF1493", "#8B4789", "#FF6A6A", "#FFB90F", "#00FF00", "#FF7F24", "#008B45", "#FF3030", "#7FFF00", "#4876FF", "#54FF9F", "#FF4040", "#8470FF", "#C0FF3E", "#FF00FF", "#00BFFF", "#9370DB", "#FF6EB4", "#008B45", "#FFD700", "#836FFF", "#8B2323", "#EE82EE", "#1E90FF", "#FF8247", "#A2CD5A", "#32CD32", "#B22222", "#FA8072", "#FF4040", "#00EEEE", "#7CCD7C", "#C0FF3E", "#FF6347", "#7FFFD4", "#90EE90", "#8B658B", "#FF34B3", "#FF83FA", "#FFF68F", "#98F5FF", "#FFCC99")),
                '2' => array('id' => '2','en_name'=>'Theme B', 'name'=>'方案二','value'=>array("#0000FF", "#8A2BE2", "#006400", "#FF0000", "#FF7F24", "#4876FF", "#8B4789", "#458B00", "#FF4500", "#FFB90F", "#8B2323", "#8470FF", "#008B45", "#FF1493", "#FF8247", "#836FFF", "#B22222", "#008B45", "#FF3030", "#FFFF00", "#00BFFF", "#9370DB", "#00FF7F", "#FF6A6A", "#FFD700", "#FF00FF", "#FF4040", "#1E90FF", "#00FF00", "#FA8072", "#EE82EE", "#7FFF00", "#00F5FF", "#8B658B", "#FF34B3", "#FFF68F", "#54FF9F", "#FF6347", "#C0FF3E", "#FF6EB4", "#00EEEE", "#A2CD5A", "#FFCC99", "#32CD32", "#98F5FF", "#7CCD7C", "#FF83FA", "#C0FF3E", "#7FFFD4", "#90EE90", "#FFD5A6")),
                '3' => array('id' => '3','en_name'=>'Theme C', 'name'=>'方案三','value'=>array("#800080", "#D2691E", "#006400", "#2828CD", "#C71585", "#AE5E1A", "#CD0000", "#9400D3", "#A0522D", "#B90000", "#6A5ACD", "#228B22", "#FF8C0A", "#8B4513", "#9932CC", "#FF0000", "#329632", "#3C5A91", "#FFB400", "#00A5FF", "#AD19EC", "#9A7745", "#F56E6E", "#FFE650", "#64CD3C", "#8C8CFF", "#0078FF", "#FFD232", "#6EE5A3", "#834683", "#DB631F", "#EB0000", "#FF9100", "#FF1493", "#52E4DC", "#96F56E", "#0064CD", "#1EA4FF", "#D36EEC", "#CD5C5C", "#FF7F50", "#D151B7", "#32BEBE", "#54BD54", "#7B68EE", "#1E90FF", "#FFC81E", "#B24BE5", "#9E5A5A", "#FFA374", "#60BD89")),
                '4' => array('id' => '4','en_name'=>'Theme D', 'name'=>'方案四','value'=>array("#FF0000", "#FF4500", "#FF8C00", "#FFD700", "#FFFF00", "#ADFF2F", "#7DFD02", "#7FFF00", "#00FF00", "#31DD5C", "#3BE0A4", "#52FFD9", "#00FFFF", "#00BFFF", "#6495ED", "#4169E1", "#0000FF", "#6A5ACD", "#8A2BE2", "#9932CC", "#CE27C5", "#DA70D6", "#FF1493", "#FF69B4")),
            ),
            
            'hcluster_method' => array(
                1 => array('name' => '无',        'value' => '','en_name'=>'None'),
                2 => array('name' => 'single',   'value' => 'single','en_name'=>'Single'),
                3 => array('name' => 'complete', 'value' => 'complete','en_name'=>'Complete'),
                4 => array('name' => 'average',  'value' => 'average','en_name'=>'Average'),
            ),
            //差异分析
            'metastat' => array(
                //参数配置
                'params' => array(
                    'test' => array(
                        'anova' => 'one-way ANOVA(单因素方差分析)',
                        'kru_H' => 'Kruskal-Wallis秩和检验',
                    ),
                    'test_en' => array(
                        'anova' => 'One-way ANOVA',
                        'kru_H' => 'Kruskal-Wallis H test',
                    ),
                    'two_group_test' => array(
                        'student' => "Student's T检验",
                        'welch' => 'Welch T检验',
                        'mann' => 'Wilcoxon秩和检验',
                        'signal' => 'Wilcoxon符号秩和检验',
                    ),
                    'two_group_test_en' => array(
                        'student' => "Student’s t-test",
                        'welch' => 'Welch’s t-test',
                        'mann' => 'Wilcoxon rank-sum test',
                        'signal' => ' Wilcoxon signed-rank test',
                    ),
                    'two_sample_test' => array(
                        'chi' => "卡方检验",
                        'fisher' => '费舍尔精确检验',
                    ),
                    'tail_type' => array(
                        'less' => '右尾检验',
                        'greater' => '左尾检验',
                        'two.side' => '双尾检验',
                    ),
                    'tail_type_en' => array(
                        'less' => 'Right-sided test',
                        'greater' => 'Left sided test',
                        'two.side' => 'Two-sided test',
                    ),
                    'ci_type' => array(
                        "Student's inverted" => "Student's inverted",
                        "Welch's inverted" => "Welch's inverted",
                        "bootstrap" => "bootstrap",
                    ),
                    'correction' => array(
                        'none' => 'none',
                        'hochberg' => 'hochberg',
                        'hommel' => 'hommel',
                        'bonferroni' => 'bonferroni',
                        'BH' => 'BH',
                        'BY' => 'BY',
                        'fdr' => 'fdr',
                    ),
                    'methor' => array(
                        'gameshowell' => 'Games-Howell',
                        'scheffe' => 'Scheffe',
                        'tukeykramer' => 'Tukey-Kramer',
                        'welchuncorrected' => 'Welch\'s(uncorrected)',
                    ),
                    'two_sample_methor' => array(
                        'DiffBetweenPropAsymptoticCC' => 'DiffBetweenPropAsymptoticCC',
                        'DiffBetweenPropAsymptotic' => 'DiffBetweenPropAsymptotic',
                        'NewcombeWilson' => 'NewcombeWilson',
                    ),
                    'coverage' => array(
                        '0.9' => 0.90,
                        '0.95' => 0.95,
                        '0.98' => 0.98,
                        '0.99' => 0.99,
                        '0.999' => 0.999,
                    ),
                    'lefse_strict' => array(  
                        0 => 'All-against-all(more strict)',
                        1 => 'One-against-all(less strict)',
                    ),
                ),

            ),
            //距离算法
            'enterotype_distance_method'=>array(
                '1'   => array('id' => '1', 'name' => 'abund_jaccard'),
                '2'   => array('id' => '2', 'name' => 'binary_jaccard'),
                '3'   => array('id' => '3', 'name' => 'bray_curtis'),
                '4'   => array('id' => '4', 'name' => 'euclidean'),
                '5'   => array('id' => '5', 'name' => 'JSD'),
            ),
            //permanova距离算法
            'permanova_distance_method'=>array(
                '1'   => array('id' => '1', 'name' => 'bray_curtis'),
                '2'   => array('id' => '2', 'name' => 'abund_jaccard'),
                '3'   => array('id' => '3', 'name' => 'binary_jaccard'),
                '4'   => array('id' => '4', 'name' => 'canberra'),
                '5'   => array('id' => '5', 'name' => 'euclidean'),
                '6'   => array('id' => '6', 'name' => 'binary_bray_curtis'),
                '7'   => array('id' => '7', 'name' => 'binary_euclidean'),
                '8'   => array('id' => '8', 'name' => 'binary_canberra'),
                '9'   => array('id' => '9', 'name' => 'binary_gower'),
                '10'   => array('id' => '10', 'name' => 'binary_horn'),
                '11'   => array('id' => '11', 'name' => 'binary_kulczynski'),
                '12'   => array('id' => '12', 'name' => 'binary_manhattan'),
                '13'   => array('id' => '13', 'name' => 'binary_morisita'),
                '14'   => array('id' => '14', 'name' => 'gower'),
                '15'   => array('id' => '15', 'name' => 'horn'),
                '16'   => array('id' => '16', 'name' => 'kulczynski'),
                '17'   => array('id' => '17', 'name' => 'manhattan'),
                '18'   => array('id' => '18', 'name' => 'morisita'),
            ),
            //关联与模型预测分析
            'prediction' => array(
                //回归分析
                'regression' => array(
                    //参数
                    'params' => array(
                        'diversity_type' => array(
                            1 => array('id' => 1, 'name' => 'α多样性', 'value' => 'alpha'),
                            2 => array('id' => 2, 'name' => 'β多样性', 'value' => 'beta'),
                        ),
                        //指数或分析类型
                        'diversity_analysis_type' => array(
                            1 => array('id' => 1, 'name' => 'Shannon', 'value' => 'shannon', 'type' => 'alpha'),
                            2 => array('id' => 2, 'name' => 'Simpson', 'value' => 'simpson', 'type' => 'alpha'),
                            3 => array('id' => 3, 'name' => 'Invsimpson', 'value' => 'invsimpson', 'type' => 'alpha'),
                            4 => array('id' => 4, 'name' => 'PCA', 'value' => 'pca', 'type' => 'beta'),
                            5 => array('id' => 5, 'name' => 'PCoA', 'value' => 'pcoa', 'type' => 'beta'),
                            6 => array('id' => 6, 'name' => 'NMDS', 'value' => 'nmds', 'type' => 'beta'),
                        ),
                    ),
                ),
                //相关性网络图
                'networkcor' => array(
                    //参数
                    'params' => array(
                        //相关性系数
                        'coefficient' => array(
                            1 => array('id' => 1, 'name' => 'Spearman', 'value' => 'spearman'),
                            2 => array('id' => 2, 'name' => 'Pearson', 'value' => 'pearson'),
                            3 => array('id' => 3, 'name' => 'Kendall', 'value' => 'kendall'),
                        ),
                    ),
                ),
            ),
           /* //关联与模型预测分析
            'prediction' => array(
                //回归分析
                'regression' => array(
                    //参数
                    'params' => array(
                        'diversity_type' => array(
                            1 => array('id' => 1, 'name' => 'α多样性', 'value' => 'alpha'),
                            2 => array('id' => 2, 'name' => 'β多样性', 'value' => 'beta'),
                        ),
                        //指数或分析类型
                        'diversity_analysis_type' => array(
                            1 => array('id' => 1, 'name' => 'Shannon', 'value' => 'shannon', 'type' => 'alpha'),
                            2 => array('id' => 2, 'name' => 'Simpson', 'value' => 'simpson', 'type' => 'alpha'),
                            3 => array('id' => 3, 'name' => 'Invimpson', 'value' => 'invsimpson', 'type' => 'alpha'),
                            4 => array('id' => 4, 'name' => 'PCA', 'value' => 'pca', 'type' => 'beta'),
                            5 => array('id' => 5, 'name' => 'PCOA', 'value' => 'pcoa', 'type' => 'beta'),
                            6 => array('id' => 6, 'name' => 'NMDS', 'value' => 'nmds', 'type' => 'beta'),
                        ),
                    ),
                ),
            ),*/
            //环境因子关联分析->相关性Heatmap图->相关性系数类型
            'coefficient' => array(
                1 => array('name' => 'Spearman', 'value' => 'spearmanr'),
                2 => array('name' => 'Pearson ', 'value' => 'pearsonr'),
                3 => array('name' => 'Kendall',  'value' => 'kendalltau'),
            ),
            //Venn图others(合并小于此数值的区域)
            'venn_others' => array(
                1 => array('name' => '0.01%', 'value' => '0.0001'),
                2 => array('name' => '0.05%', 'value' => '0.0005'),
                3 => array('name' => '0.1%',  'value' => '0.001'),
                4 => array('name' => '1%',    'value' => '0.01'),
                5 => array('name' => '5%',    'value' => '0.05'),
            ),
            'nr' => array(
                'level' => array(
                    1 => array('id' => 1, 'name' => 'Domain',  'type' => 3, 'pre' => 'd__','val'=>'d'),
                    2 => array('id' => 2, 'name' => 'Kingdom', 'type' => 3, 'pre' => 'k__','val'=>'k'),
                    3 => array('id' => 3, 'name' => 'Phylum',  'type' => 3, 'pre' => 'p__','val'=>'p'),
                    4 => array('id' => 4, 'name' => 'Class',   'type' => 3, 'pre' => 'c__','val'=>'c'),
                    5 => array('id' => 5, 'name' => 'Order',   'type' => 3, 'pre' => 'o__','val'=>'o'),
                    6 => array('id' => 6, 'name' => 'Family',  'type' => 3, 'pre' => 'f__','val'=>'f'),
                    7 => array('id' => 7, 'name' => 'Genus',   'type' => 3, 'pre' => 'g__','val'=>'g'),
                    8 => array('id' => 8, 'name' => 'Species', 'type' => 3, 'pre' => 's__','val'=>'s'),
                ),
                'action_name' => 'Nr',
            ),
            'cog' => array(
                'level' => array(
                    9  => array('id'=>9, 'name' => 'Category', 'type' => 1),
                    10 => array('id'=>10,'name' => 'Function', 'type' => 1),
                    11 => array('id'=>11,'name' => 'NOG',      'type' => 3),
                ),
                'action_name' => 'Cog',
            ),
            'kegg' => array(
                'level' => array(
                    12 => array('id'=>12,'name' => 'Pathway Level1',     'type' => 1),
                    13 => array('id'=>13,'name' => 'Pathway Level2',     'type' => 2),
                    14 => array('id'=>14,'name' => 'Pathway Level3',     'type' => 3),
                    15 => array('id'=>15,'name' => 'Module',             'type' => 3),
                    16 => array('id'=>16,'name' => 'Enzyme',             'type' => 3),
                    17 => array('id'=>17,'name' => 'KO(KEGG Orthology)', 'type' => 3),
                ),
                'action_name' => 'Kegg',
            ),
            'cazy' => array(
                'level' => array(
                    18 => array('id'=>18,'name' => 'Class',  'type' => 1),
                    19 => array('id'=>19,'name' => 'Family', 'type' => 3),
                ),
                'action_name' => 'Cazy',
            ),
            'ardb' => array(
                'level' => array(
                    20 => array('id'=>20,'name' => 'Class',                            'type' => 2),
                    21 => array('id'=>21,'name' => 'Type',                             'type' => 2),
                    22 => array('id'=>22,'name' => 'Antibiotic type',                  'type' => 2),
                    23 => array('id'=>23,'name' => 'ARG Antibiotic resistance gene', 'type' => 3),
                ),
                'action_name' => 'Ardb',
            ),
            'card' => array(
                'level' => array(
                    24 => array('id'=>24,'name' => 'Class', 'type' => 1),
                    25 => array('id'=>25,'name' => 'ARO',   'type' => 3),
                ),
                'action_name' => 'Card',
            ),
            'vfdb' => array(
                'level' => array(
                    26 => array('id'=>26,'name' => 'Level1',            'type' => 1),
                    27 => array('id'=>27,'name' => 'Level2',            'type' => 1),
                    28 => array('id'=>28,'name' => 'Virulence factors', 'type' => 3),
                ),
                'action_name' => 'Vfdb',
            ),
            'gene' => array(
                'action_name' => 'Gene',
            ),
            'qs' => array(
                'level' => array(
                    52 => array('id'=>52,'name' => 'Class',  'type' => 1),
                ),
                'action_name' => 'Qs',
            ),
            'go' => array(
                'level' => array(
                    59 => array('id'=>1,'name' => 'Level1',  'type' => 3),
                    60 => array('id'=>2,'name' => 'Level2',  'type' => 3),
                    61=> array('id'=>3,'name' => 'Level3',  'type' => 3),
                    62=> array('id'=>4,'name' => 'Level4',  'type' => 3),
                ),
                'action_name' => 'Go',
            ),
            'probio'=>array(
                    'level' => array(
                        53 => array('id'=>53,'name' => 'Probiotic name',  'type' => 3),
                        54 => array('id'=>54,'name' => 'Probiotics genus',  'type' => 1),
                        55=> array('id'=>55,'name' => 'Use in',  'type' => 1),
                        56=> array('id'=>56,'name' => 'Disease class',  'type' => 1),
                        57=> array('id'=>57,'name' => 'Commercial Development Stage',  'type' => 1),
                        66=> array('id'=>66,'name' => 'Probiotic Effect',  'type' => 2),
                    ),
                'action_name' => 'Probio',
                ),
            'level'=>array(    
                    'nr' => array(
                        'level' => array(
                            1 => array('id' => 1, 'name' => 'Domain',  'type' => 3, 'pre' => 'd__','val'=>'d'),
                            2 => array('id' => 2, 'name' => 'Kingdom', 'type' => 3, 'pre' => 'k__','val'=>'k'),
                            3 => array('id' => 3, 'name' => 'Phylum',  'type' => 3, 'pre' => 'p__','val'=>'p'),
                            4 => array('id' => 4, 'name' => 'Class',   'type' => 3, 'pre' => 'c__','val'=>'c'),
                            5 => array('id' => 5, 'name' => 'Order',   'type' => 3, 'pre' => 'o__','val'=>'o'),
                            6 => array('id' => 6, 'name' => 'Family',  'type' => 3, 'pre' => 'f__','val'=>'f'),
                            7 => array('id' => 7, 'name' => 'Genus',   'type' => 3, 'pre' => 'g__','val'=>'g'),
                            8 => array('id' => 8, 'name' => 'Species', 'type' => 3, 'pre' => 's__','val'=>'s'),
                        ),
                        'action_name' => 'Nr',
                    ),
                    'cog' => array(
                        'level' => array(
                            9  => array('id'=>9, 'name' => 'Category', 'type' => 1),
                            10 => array('id'=>10,'name' => 'Function', 'type' => 1),
                            11 => array('id'=>11,'name' => 'NOG',      'type' => 3),
                        ),
                        'action_name' => 'Cog',
                    ),
                    'kegg' => array(
                        'level' => array(
                            12 => array('id'=>12,'name' => 'Pathway Level1',     'type' => 1),
                            13 => array('id'=>13,'name' => 'Pathway Level2',     'type' => 2),
                            14 => array('id'=>14,'name' => 'Pathway Level3',     'type' => 3),
                            15 => array('id'=>15,'name' => 'Module',             'type' => 3),
                            16 => array('id'=>16,'name' => 'Enzyme',             'type' => 3),
                            17 => array('id'=>17,'name' => 'KO(KEGG Orthology)', 'type' => 3),
                        ),
                        'action_name' => 'Kegg',
                    ),
                    'cazy' => array(
                        'level' => array(
                            18 => array('id'=>18,'name' => 'Class',  'type' => 1),
                            19 => array('id'=>19,'name' => 'Family', 'type' => 3),
                        ),
                        'action_name' => 'Cazy',
                    ),
                    'ardb' => array(
                        'level' => array(
                            20 => array('id'=>20,'name' => 'Class',                            'type' => 2),
                            21 => array('id'=>21,'name' => 'Type',                             'type' => 2),
                            22 => array('id'=>22,'name' => 'Antibiotic type',                  'type' => 2),
                            23 => array('id'=>23,'name' => 'ARG Antibiotic resistance gene', 'type' => 3),
                        ),
                        'action_name' => 'Ardb',
                    ),
                    'card' => array(
                        'level' => array(
                            24 => array('id'=>24,'name' => 'Class', 'type' => 1),
                            25 => array('id'=>25,'name' => 'ARO',   'type' => 3),
                        ),
                        'action_name' => 'Card',
                    ),
                    'vfdb' => array(
                        'level' => array(
                            26 => array('id'=>26,'name' => 'Level1',            'type' => 1),
                            27 => array('id'=>27,'name' => 'Level2',            'type' => 1),
                            28 => array('id'=>28,'name' => 'Virulence factors', 'type' => 3),
                        ),
                        'action_name' => 'Vfdb',
                    ),
                    'gene' => array(
                        'action_name' => 'Gene',
                    ),
                    'qs' => array(
                        'level' => array(
                            52 => array('id'=>52,'name' => 'Class',  'type' => 1),
                        ),
                        'action_name' => 'Qs',
                    ),
                    'go' => array(
                        'level' => array(
                            59 => array('id'=>1,'name' => 'Level1',  'type' => 3),
                            60 => array('id'=>2,'name' => 'Level2',  'type' => 3),
                            61=> array('id'=>3,'name' => 'Level3',  'type' => 3),
                            62=> array('id'=>4,'name' => 'Level4',  'type' => 3),
                        ),
                        'action_name' => 'Go',
                    ),
                    'probio'=>array(
                            'level' => array(
                                53 => array('id'=>53,'name' => 'Probiotic name',  'type' => 3),
                                54 => array('id'=>54,'name' => 'Probiotics genus',  'type' => 1),
                                55=> array('id'=>55,'name' => 'Use in',  'type' => 1),
                                56=> array('id'=>56,'name' => 'Disease class',  'type' => 1),
                                57=> array('id'=>57,'name' => 'Commercial Development Stage',  'type' => 1),
                                66=> array('id'=>66,'name' => 'Probiotic Effect',  'type' => 2),
                            ),
                        'action_name' => 'Probio',
                        ),
                    'p450' => array(
                        'level' => array(
                            33 => array('id'=>33,'name' => 'Homologous Family',  'type' => 1),
                            34 => array('id'=>34,'name' => 'Superfamily',  'type' => 1),
                        ),
                        'action_name' => 'P450',
                    ),
                    'pfam' => array(
                        'level' => array(
                            30 => array('id'=>30,'name' => 'Type',  'type' => 1),
                            31=> array('id'=>31,'name' => 'CLAN ID',  'type' => 2),
                            32=> array('id'=>32,'name' => 'Pfam ID',  'type' => 3),
                        ),
                        'action_name' => 'Pfam',
                    ),
                    'mvirdb' => array(
                        'level' => array(
                            35 => array('id'=>35,'name' => 'Status',  'type' => 1),
                            36 => array('id'=>36,'name' => 'Gene Description（species）',  'type' => 2),
                            37 => array('id'=>37,'name' => 'Virulence Factor Type',  'type' => 1),
                            38 => array('id'=>38,'name' => 'Database Source',  'type' => 1),
                            39 => array('id'=>39,'name' => 'Virulence Factor ID',  'type' => 3),
                        ),
                        'action_name' => 'Mvirdb',
                    ),
                    'phi' => array(
                        'level' => array(
                            40 => array('id'=>40,'name' => 'Pathogen_species',  'type' => 1),
                            41 => array('id'=>41,'name' => 'Mutant_phenotype',  'type' => 1),
                            42=> array('id'=>42,'name' => 'Experiment_host_species',  'type' => 2),
                            43=> array('id'=>43,'name' => 'Function',  'type' => 2),
                            44=> array('id'=>44,'name' => 'PHI_ID',  'type' => 3),
                            45=> array('id'=>45,'name' => 'Protein_ID',  'type' =>2),
                            46=> array('id'=>46,'name' => 'Pathogen_gene',  'type' => 2),
                            47=> array('id'=>47,'name' => 'Host_classification',  'type' => 2),
                        ),
                        'action_name' => 'Phi',
                    ),
                    'tcdb' => array(
                        'level' => array(
                            48 => array('id'=>48,'name' => 'Class',  'type' => 1),
                            49 => array('id'=>49,'name' => 'Subclass',  'type' => 1),
                            50 => array('id'=>50,'name' => 'Family',  'type' => 2),
                            51 => array('id'=>51,'name' => 'TCDB ID',  'type' => 3),
                        ),
                        'action_name' => 'Tcdb',
                    ),
                    'secpro' => array(
                        'level' => array(
                            63 => array('id'=>63,'name' => 'Gram neg',  'type' => 1),
                            64 => array('id'=>64,'name' => 'Gram pos',  'type' => 1),
                            65 => array('id'=>65,'name' => 'Fungi',  'type' => 1),
                        ),
                        'action_name' => 'Secpro',
                    ),
                ),
            'pfam' => array(
                    'level' => array(
                        30 => array('id'=>30,'name' => 'Type',  'type' => 1),
                        31=> array('id'=>31,'name' => 'CLAN ID',  'type' => 2),
                        32=> array('id'=>32,'name' => 'Pfam ID',  'type' => 3),
                    ),
                    'action_name' => 'Pfam',
            ),
            'p450' => array(
                'level' => array(
                    33 => array('id'=>33,'name' => 'Homologous Family',  'type' => 2),
                    34 => array('id'=>34,'name' => 'Superfamily',  'type' => 2),
                ),
                'action_name' => 'P450',
            ),
            'mvirdb' => array(
                'level' => array(
                    35 => array('id'=>35,'name' => 'Status',  'type' => 1),
                    36 => array('id'=>36,'name' => 'Gene Description（species）',  'type' => 2),
                    37 => array('id'=>37,'name' => 'Virulence Factor Type',  'type' => 1),
                    38 => array('id'=>38,'name' => 'Database Source',  'type' => 1),
                    39 => array('id'=>39,'name' => 'Virulence Factor ID',  'type' => 3),
                ),
                'action_name' => 'Mvirdb',
            ),
            'phi' => array(
                'level' => array(
                        40 => array('id'=>40,'name' => 'Pathogen_species',  'type' => 1),
                        41 => array('id'=>41,'name' => 'Mutant_phenotype',  'type' => 1),
                        42=> array('id'=>42,'name' => 'Experiment_host_species',  'type' => 2),
                        43=> array('id'=>43,'name' => 'Function',  'type' => 2),
                        44=> array('id'=>44,'name' => 'PHI_ID',  'type' => 3),
                        45=> array('id'=>45,'name' => 'Protein_ID',  'type' =>2),
                        46=> array('id'=>46,'name' => 'Pathogen_gene',  'type' => 2),
                        
                        47=> array('id'=>47,'name' => 'Host_classification',  'type' => 2),
                ),
                'action_name' => 'Phi',
            ),
            'tcdb' => array(
                'level' => array(
                    48 => array('id'=>48,'name' => 'Class',  'type' => 1),
                    49 => array('id'=>49,'name' => 'Subclass',  'type' => 1),
                    50 => array('id'=>50,'name' => 'Family',  'type' => 2),
                    51 => array('id'=>51,'name' => 'TCDB ID',  'type' => 2),
                ),
                'action_name' => 'Tcdb',
            ),
            'secpro' => array(
                'level' => array(
                    63 => array('id'=>63,'name' => 'Gram neg',  'type' => 1),
                    64 => array('id'=>64,'name' => 'Gram pos',  'type' => 1),
                    65 => array('id'=>65,'name' => 'Fungi',  'type' => 1),
                ),
                'action_name' => 'Secpro',
            ),
            //形状分组方案
            'map_shape' => array(
                '1' => array('id' => '1' , 'name' => '圆' , 'val' => 'circle'),
                '2' => array('id' => '2' , 'name' => '三角' , 'val' => 'triangle'),
                '3' => array('id' => '3' , 'name' => '菱形' , 'val' => 'diamond'),
                '4' => array('id' => '4' , 'name' => '正方' , 'val' => 'square'),
                '5' => array('id' => '5' , 'name' => '加号' , 'val' => 'cross'),
                '6' => array('id' => '6' , 'name' => '倒三角' , 'val' => 'triangle-down'),
           ),
            'map_shape_en' => array(
                '1' => array('id' => '1' , 'name' => 'circle' , 'val' => 'circle'),
                '2' => array('id' => '2' , 'name' => 'triangle' , 'val' => 'triangle'),
                '3' => array('id' => '3' , 'name' => 'diamond' , 'val' => 'diamond'),
                '4' => array('id' => '4' , 'name' => 'square' , 'val' => 'square'),
                '5' => array('id' => '5' , 'name' => 'plus' , 'val' => 'cross'),
                '6' => array('id' => '6' , 'name' => 'triangle down' , 'val' => 'triangle-down'),
           ),
            //mixPlot形状分组方案
            'mix_map_shape' => array(
                '1' => array('id' => '1' , 'name' => '圆' , 'val' => 'circle'),
                '2' => array('id' => '2' , 'name' => '正三角' , 'val' => 'triangle-up'),
                '3' => array('id' => '3' , 'name' => '菱形' , 'val' => 'diamond'),
                '4' => array('id' => '4' , 'name' => '正方' , 'val' => 'square'),
                '5' => array('id' => '5' , 'name' => '加号' , 'val' => 'cross'),
                '6' => array('id' => '6' , 'name' => '倒三角' , 'val' => 'triangle-down'),
            ),
            //mixPlot颜色透明度
            'mix_opacity' => array(
                1 => array('id' => 1, 'name' => 0.1, 'val' => 0.1),
                2 => array('id' => 2, 'name' => 0.2, 'val' => 0.2),
                3 => array('id' => 3, 'name' => 0.3, 'val' => 0.3),
                4 => array('id' => 4, 'name' => 0.4, 'val' => 0.4),
                5 => array('id' => 5, 'name' => 0.5, 'val' => 0.5),
                6 => array('id' => 6, 'name' => 0.6, 'val' => 0.6),
                7 => array('id' => 7, 'name' => 0.7, 'val' => 0.7),
                8 => array('id' => 8, 'name' => 0.8, 'val' => 0.8),
                9 => array('id' => 9, 'name' => 0.9, 'val' => 0.9),
                10 => array('id' => 10, 'name' => 1, 'val' => 1),
            ),

            //环境因子tables
            'beta_pca_columns' => array(
                'species'           => '主成分贡献度表',
                'factor'            => '类别型环境因子坐标表',
                'vector'            => '数量型环境因子坐标表',
                'factor_stat'       => '类别型环境因子表',
                'vector_stat'       => '数量型环境因子表',
                'importance'        => '主成分解释度表',
                'specimen'          => '样本坐标表',
            ),
            'beta_pcoa_columns' => array(
                'eigenvalues'        => '矩阵特征值',
                'specimen'          => '样本坐标表',
            ),
            'beta_dbrda_columns' => array(
                'factor'         => '类别型环境因子坐标表',
                'vector'         => '数量型环境因子坐标表',
                'specimen'       => '样本坐标表',
				'envfit'         => 'envfit环境因子表',
            ),
            'beta_rda_cca_columns' => array(
                'factor'            => '类别型环境因子坐标表',
                'vector'            => '数量型环境因子坐标表',
                'importance'        => '主成分解释度表',
                'species'           => '物种坐标表',
                'specimen'   => '样本坐标表',
                'dca'        => 'DCA分析结果',
                'envfit'     => 'envfit环境因子表',
            ),
            'beta_plsda_columns' => array(
                'importance'        => '分组主成分解释度表',
                'species'           => '物种主成分贡献度表',
                'specimen'          => '样本坐标表',
            ),
            'beta_nmds_columns' => array(   
                'specimen'   => '样本坐标表',
            ),
            //环境因子tables
            'beta_pca_columns_en' => array(
                'species'           => 'Principal component contribution ',
                'factor'            => 'Categorical environmental factor coordinate',
                'vector'            => 'Quantitative environmental factor coordinate',
                'factor_stat'       => 'Categorical environmental factor',
                'vector_stat'       => 'Quantitative environmental factor',
                'importance'        => 'Principal component interpretation',
                'specimen'          => 'Sample coordinate',
            ),
            'beta_pcoa_columns_en' => array(
                'eigenvalues'        => 'Eigenvalue of matrix',
                'specimen'          => 'Sample coordinate',
            ),
            'beta_dbrda_columns_en' => array(
                'factor'         => 'Categorical environmental factor',
                'vector'         => 'Quantitative environmental factor',
                'specimen'       => 'Sample coordinate',
                'envfit'         => 'Envfit environmental factor',
            ),
            'beta_rda_cca_columns_en' => array(
                'factor'            => 'Categorical environmental factor',
                'vector'            => 'Quantitative environmental factors coordinate table',
                'importance'        => 'Principal component interpretation',
                'species'           => 'coordinate ',
                'specimen'   => 'Sample coordinate',
                'dca'        => 'DCA analysis results',
                'envfit'     => 'Envfit environmental factor ',
            ),
            'beta_plsda_columns_en' => array(
                'importance'        => ' Principal component interpretation of groups',
                'species'           => 'Principal component contribution ',
                'specimen'          => 'Sample coordinate',
            ),
            'beta_nmds_columns_en' => array(   
                'specimen'   => 'Sample coordinate',
            ),
            'anno_overview' => array(
                '1' =>array('name' =>'Gene ID','val'=>'gene_id','field'=>array()),
                '2' =>array('name' =>'Taxon','val'=>'nr','field'=>array('nr_1','nr_2','nr_3','nr_4','nr_5','nr_6','nr_7','nr_8')),
                '3' =>array('name' =>'COG','val'=>'cog','field'=>array('cog_11','nog_des','function','function_des','category')),
                '4' =>array('name' =>'KEGG','val'=>'kegg','field'=>array('kegg_gene','kegg_17','ko_desc','pathway_id','pathway_category3','enzyme_id','enzyme_category','module_id','module_category','pathway_category1','pathway_category2')),
                '5' =>array('name' =>'CAZy','val'=>'cazy','field'=>array('cazy_19','cazy_class','cazy_class_des','family_des')),
                '6' =>array('name' =>'ARDB','val'=>'ardb','field'=>array('ardb_23','type','resistance','ardb_class','ardb_class_des')),
                '7' =>array('name' =>'CARD','val'=>'card','field'=>array('card_25','aro_name','aro_description','aro_category','card_class')),
                '8' =>array('name' =>'VFDB','val'=>'vfdb','field'=>array('vfdb_28','vf_function','origin','level1','level2')),
                ),
            'gene_anno_overview' => array(
                '1' =>array('name' =>'Gene ID','val'=>'gene_id','field'=>array()),
                '2' =>array('name' =>'Taxon','val'=>'nr','field'=>array('nr_1','nr_2','nr_3','nr_4','nr_5','nr_6','nr_7','nr_8','lca_nr_1','lca_nr_2','lca_nr_3','lca_nr_4','lca_nr_5','lca_nr_6','lca_nr_7','lca_nr_8','duc_nr_1','duc_nr_2','duc_nr_3','duc_nr_4','duc_nr_5','duc_nr_6','duc_nr_7','duc_nr_8')),
                '3' =>array('name' =>'COG','val'=>'cog','field'=>array('cog_11','nog_des','function','function_des','category')),
                '4' =>array('name' =>'KEGG','val'=>'kegg','field'=>array('kegg_gene','kegg_17','ko_desc','pathway_id','pathway_category3','enzyme_id','enzyme_category','module_id','module_category','pathway_category1','pathway_category2')),
            
                '5' =>array('name' =>'CAZy','val'=>'cazy','field'=>array('cazy_19','cazy_class','cazy_class_des','family_des')),
                '6' =>array('name' =>'ARDB','val'=>'ardb','field'=>array('ardb_23','type','resistance','ardb_class','ardb_class_des')),
                '7' =>array('name' =>'CARD','val'=>'card','field'=>array('card_25','aro_name','aro_description','aro_category','card_class')),
                '8' =>array('name' =>'VFDB','val'=>'vfdb','field'=>array('vfdb_28','vf_function','origin','level1','level2')),
                '9' =>array('name' =>'GO','val'=>'go','database'=>'go','field'=>array('go_59','go_60','go_61','go_62')),
                '10' =>array('name' =>'PHI','val'=>'phi','database'=>'phi','field'=>array('phi_40','phi_41','phi_47')),
                '11' =>array('name' =>'MvirDB','val'=>'mvirdb','database'=>'mvir','field'=>array('mvir_36','mvir_37')),
                '12' =>array('name' =>'TCDB','val'=>'tcdb','database'=>'tcdb','field'=>array('tcdb_48','tcdb_49','tcdb_50')),
                '13' =>array('name' =>'QS','val'=>'qs','database'=>'qs','field'=>array('qs_52')),
                '14' =>array('name' =>'Pfam','val'=>'pfam','database'=>'pfam','field'=>array('pfam_29','pfam_30')),
                '15' =>array('name' =>'Probio','val'=>'probio','database'=>'probio','field'=>array('probio_53','probio_54','probio_55','probio_66')),
                '16' =>array('name' =>'P450','val'=>'p450','database'=>'p450','field'=>array('p450_33','p450_34')),
                '17' =>array('name' =>'Secretory Protein','val'=>'secpro','field'=>array('secpro_63','secpro_64','secpro_65')),
                '18' =>array('name' =>'T3SS','val'=>'ttss','field'=>array('t3ss_67')),
                //'17' =>array('name' =>'Secretory Protein','val'=>'secpro','field'=>array('secpro_63','secpro_64','secpro_65')),
                ),
            'database_type_overview' => array(
                '1' =>array('name' =>'Gene ID','val'=>'gene_id','field'=>array()),
                '2' =>array('name' =>'Taxon','val'=>'nr','field'=>array('nr_1','nr_2','nr_3','nr_4','nr_5','nr_6','nr_7','nr_8','lca_nr_1','lca_nr_2','lca_nr_3','lca_nr_4','lca_nr_5','lca_nr_6','lca_nr_7','lca_nr_8','duc_nr_1','duc_nr_2','duc_nr_3','duc_nr_4','duc_nr_5','duc_nr_6','duc_nr_7','duc_nr_8')),
                '3' =>array('name' =>'KEGG','val'=>'kegg','field'=>array('kegg_gene','kegg_17','ko_desc','pathway_id','pathway_category3','enzyme_id','enzyme_category','module_id','module_category','pathway_category1','pathway_category2')),
                '4' =>array('name' =>'GO','val'=>'go','database'=>'go','field'=>array('go_59','go_60','go_61','go_62')),
                '5' =>array('name' =>'PHI','val'=>'phi','database'=>'phi','field'=>array('phi_40','phi_41','phi_47')),
                '6' =>array('name' =>'MvirDB','val'=>'mvirdb','database'=>'mvir','field'=>array('mvir_36','mvir_37')),
                '7' =>array('name' =>'TCDB','val'=>'tcdb','database'=>'tcdb','field'=>array('tcdb_48','tcdb_49','tcdb_50')),
                '8' =>array('name' =>'QS','val'=>'qs','database'=>'qs','field'=>array('qs_52')),
                '9' =>array('name' =>'Pfam','val'=>'pfam','database'=>'pfam','field'=>array('pfam_29','pfam_30')),
                '10' =>array('name' =>'Probio','val'=>'probio','database'=>'probio','field'=>array('probio_53','probio_54','probio_55','probio_66')),
                '11' =>array('name' =>'P450','val'=>'p450','database'=>'p450','field'=>array('p450_33','p450_34')),
                '12' =>array('name' =>'Secretory Protein','val'=>'secpro','field'=>array('secpro_63','secpro_64','secpro_65')),
                '13' =>array('name' =>'T3SS','val'=>'ttss','field'=>array('t3ss_67')),
                ),
            'prompt_directory' => array(   
                'sg_beta_diversity_pca_nr_env'     => '由于数据较多，文件太大，请前往项目文件PCA_NR文件夹中下载',
                'sg_beta_diversity_pca_kegg_env'   => '由于数据较多，文件太大，请前往项目文件PCA_KEGG文件夹中下载',
                'sg_beta_diversity_pca_cog_env'    => '由于数据较多，文件太大，请前往项目文件PCA_COG文件夹中下载',
                'sg_beta_diversity_pca_cazy_env'   => '由于数据较多，文件太大，请前往项目文件PCA_CAZy文件夹中下载',
                'sg_beta_diversity_pca_ardb_env'   => '由于数据较多，文件太大，请前往项目文件PCA_ARDB文件夹中下载',
                'sg_beta_diversity_pca_card_env'   => '由于数据较多，文件太大，请前往项目文件PCA_CARD文件夹中下载',
                'sg_beta_diversity_pca_vfdb_env'   => '由于数据较多，文件太大，请前往项目文件PCA_VFDB文件夹中下载',
                'sg_beta_diversity_pca_gene_env'   => '由于数据较多，文件太大，请前往项目文件PCA_GENE文件夹中下载',
            ),
            'enterotype_cluster' => array(   
                '1'   => '一',
                '2'   => '二',
                '3'   => '三',
                '4'   => '四',
                '5'   => '五',
                '6'   => '六',
                '7'   => '七',
                '8'   => '八',
                '9'   => '九',
            ),
        );
    }
    /**
     * 控制器配置
     *
     * @return   array
     **/
    static private function getControllerConfig()
    {   

        $prefix = LANG =='en'?'\en_Report':"\Report";
        return array(
            'controller_config' => array(
                $prefix.'\Controller\Metag\NetWorkCorController',
                $prefix.'\Controller\Metag\NetWorkController',
                $prefix.'\Controller\Metag\ContributeController',
                $prefix.'\Controller\Metag\RegressionController',
                $prefix.'\Controller\Metag\LefseController',
                $prefix.'\Controller\Metag\MetastatController',
                $prefix.'\Controller\Metag\VennController',
                $prefix.'\Controller\Metag\HeatmapCorController',
                $prefix.'\Controller\Metag\CompositionController',
                $prefix.'\Controller\Metag\DataStatController',
                $prefix.'\Controller\Metag\SpecimenController',
                $prefix.'\Controller\Metag\AssembleStatController',
                $prefix.'\Controller\Metag\PredictGeneController',
                $prefix.'\Controller\Metag\GenesetController',
                $prefix.'\Controller\Metag\AnnoNrController',
                $prefix.'\Controller\Metag\AnnoCogController',
                $prefix.'\Controller\Metag\AnnoKeggController',
                $prefix.'\Controller\Metag\AnnoCazyController',
                $prefix.'\Controller\Metag\AnnoArdbController',
                $prefix.'\Controller\Metag\AnnoCardController',
                $prefix.'\Controller\Metag\AnnoVfdbController',
                $prefix.'\Controller\Metag\AnnooverviewController',
                $prefix.'\Controller\Metag\HclusterTreeController',
                $prefix.'\Controller\Metag\BetaDiversityController',
                $prefix.'\Controller\Metag\EnvController',
                $prefix.'\Controller\Metag\EnvVifController',
                $prefix.'\Controller\Metag\MantelTestController',
                $prefix.'\Controller\Metag\AnosimController',
                $prefix.'\Controller\Metag\PermanovaController',
                $prefix.'\Controller\Metag\EnterotypeController',
                $prefix.'\Controller\Metag\StatusController',
                $prefix.'\Controller\Metag\SoftwareController',
                $prefix.'\Controller\Metag\AnnoController',
                $prefix.'\Controller\Metag\AnnoPfamController',
                $prefix.'\Controller\Metag\AnnoCypsController',
                $prefix.'\Controller\Metag\AnnoQsController',
                $prefix.'\Controller\Metag\AnnoSecController',
                $prefix.'\Controller\Metag\AnnoGoController',
                $prefix.'\Controller\Metag\RandomforestController',
                $prefix.'\Controller\Metag\RocController',
                $prefix.'\Controller\Metag\AnnoProbioController',
                $prefix.'\Controller\Metag\AnnoTcdbController',
                $prefix.'\Controller\Metag\AnnoPhiController',
                $prefix.'\Controller\Metag\AnnoMvirController',
                $prefix.'\Controller\Metag\AnnoTtssController',
                $prefix.'\Controller\Metag\AnnoPersonalController',
                $prefix.'\Controller\Metag\VpaController',
                $prefix.'\Controller\Metag\FuncsetController',
                $prefix.'\Controller\Metag\DiffController',
                $prefix.'\Controller\Metag\IpathController',

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
                'user_name'     => 'meta',
                'user_password' => 'aaaaa',
                'db_name'       => 'bbbbbbb',
                'authMechanism' => 'SCRAM-SHA-1',
            ),
            'offline'   => array(
                'host'          => '1.1.1.1',
                'user_name'     => 'meta',
                'user_password' => 'aaaaa',
                'db_name'       => 'bbbbb',
                'authMechanism' => 'SCRAM-SHA-1',
            ),
        );
    }
}

