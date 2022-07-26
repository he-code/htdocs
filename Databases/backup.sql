PGDMP     6    3                z            sistema    14.2    14.2 @    C           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            D           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            E           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            F           1262    16532    sistema    DATABASE     c   CREATE DATABASE sistema WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'Spanish_Spain.1252';
    DROP DATABASE sistema;
                postgres    false            �            1259    16533    acta_entrada    TABLE       CREATE TABLE public.acta_entrada (
    codigo text NOT NULL,
    tipo text NOT NULL,
    ci_ruc text NOT NULL,
    id_proovedor integer NOT NULL,
    factura text NOT NULL,
    proceso text,
    solicitud text,
    fecha timestamp without time zone NOT NULL
);
     DROP TABLE public.acta_entrada;
       public         heap    postgres    false            �            1259    16538    acta_entrada_id_proovedor_seq    SEQUENCE     �   CREATE SEQUENCE public.acta_entrada_id_proovedor_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.acta_entrada_id_proovedor_seq;
       public          postgres    false    209            G           0    0    acta_entrada_id_proovedor_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.acta_entrada_id_proovedor_seq OWNED BY public.acta_entrada.id_proovedor;
          public          postgres    false    210            �            1259    16539    acta_entrega    TABLE     �   CREATE TABLE public.acta_entrega (
    numero text NOT NULL,
    cedula_usuario character(10) NOT NULL,
    fecha timestamp without time zone NOT NULL,
    cedula_lider character(10) NOT NULL
);
     DROP TABLE public.acta_entrega;
       public         heap    postgres    false            �            1259    16544    acta_entrega_materiales    TABLE     �   CREATE TABLE public.acta_entrega_materiales (
    numero_acta text NOT NULL,
    orden_compra text NOT NULL,
    cantidad integer NOT NULL
);
 +   DROP TABLE public.acta_entrega_materiales;
       public         heap    postgres    false            �            1259    16549 
   categorias    TABLE     V   CREATE TABLE public.categorias (
    id integer NOT NULL,
    nombre text NOT NULL
);
    DROP TABLE public.categorias;
       public         heap    postgres    false            �            1259    16554    categorias_id_seq    SEQUENCE     �   CREATE SEQUENCE public.categorias_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.categorias_id_seq;
       public          postgres    false    213            H           0    0    categorias_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.categorias_id_seq OWNED BY public.categorias.id;
          public          postgres    false    214            �            1259    16555    instituciones    TABLE     M   CREATE TABLE public.instituciones (
    id text NOT NULL,
    nombre text
);
 !   DROP TABLE public.instituciones;
       public         heap    postgres    false            �            1259    16560    lideres    TABLE     �   CREATE TABLE public.lideres (
    cedula character(10) NOT NULL,
    nombre text NOT NULL,
    apellido text NOT NULL,
    cargo text NOT NULL,
    id_institucion text NOT NULL
);
    DROP TABLE public.lideres;
       public         heap    postgres    false            �            1259    16565 
   materiales    TABLE     �   CREATE TABLE public.materiales (
    orden_compra text NOT NULL,
    descripcion text NOT NULL,
    cant numeric NOT NULL,
    valor_unitario numeric NOT NULL,
    id_proovedor integer NOT NULL,
    codigo_acta_entrada text
);
    DROP TABLE public.materiales;
       public         heap    postgres    false            �            1259    16570    materiales_categorias    TABLE     q   CREATE TABLE public.materiales_categorias (
    orden_compra text NOT NULL,
    id_categoria integer NOT NULL
);
 )   DROP TABLE public.materiales_categorias;
       public         heap    postgres    false            �            1259    16575 &   materiales_categorias_id_categoria_seq    SEQUENCE     �   CREATE SEQUENCE public.materiales_categorias_id_categoria_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 =   DROP SEQUENCE public.materiales_categorias_id_categoria_seq;
       public          postgres    false    218            I           0    0 &   materiales_categorias_id_categoria_seq    SEQUENCE OWNED BY     q   ALTER SEQUENCE public.materiales_categorias_id_categoria_seq OWNED BY public.materiales_categorias.id_categoria;
          public          postgres    false    219            �            1259    16576    materiales_id_seq    SEQUENCE     �   CREATE SEQUENCE public.materiales_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.materiales_id_seq;
       public          postgres    false    217            J           0    0    materiales_id_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.materiales_id_seq OWNED BY public.materiales.id_proovedor;
          public          postgres    false    220            �            1259    16577    proovedores    TABLE     �   CREATE TABLE public.proovedores (
    id integer NOT NULL,
    nombre text NOT NULL,
    apellido text,
    telefono text,
    direccion text
);
    DROP TABLE public.proovedores;
       public         heap    postgres    false            �            1259    16582    proovedores_id_seq    SEQUENCE     �   CREATE SEQUENCE public.proovedores_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.proovedores_id_seq;
       public          postgres    false    221            K           0    0    proovedores_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.proovedores_id_seq OWNED BY public.proovedores.id;
          public          postgres    false    222            �            1259    16583    usuarios    TABLE     �   CREATE TABLE public.usuarios (
    cedula character(10) NOT NULL,
    nombre text NOT NULL,
    apellido text NOT NULL,
    correo text NOT NULL,
    password text NOT NULL,
    cargo text,
    permission integer
);
    DROP TABLE public.usuarios;
       public         heap    postgres    false            �           2604    16588    acta_entrada id_proovedor    DEFAULT     �   ALTER TABLE ONLY public.acta_entrada ALTER COLUMN id_proovedor SET DEFAULT nextval('public.acta_entrada_id_proovedor_seq'::regclass);
 H   ALTER TABLE public.acta_entrada ALTER COLUMN id_proovedor DROP DEFAULT;
       public          postgres    false    210    209            �           2604    16589    categorias id    DEFAULT     n   ALTER TABLE ONLY public.categorias ALTER COLUMN id SET DEFAULT nextval('public.categorias_id_seq'::regclass);
 <   ALTER TABLE public.categorias ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    214    213            �           2604    16590    materiales id_proovedor    DEFAULT     x   ALTER TABLE ONLY public.materiales ALTER COLUMN id_proovedor SET DEFAULT nextval('public.materiales_id_seq'::regclass);
 F   ALTER TABLE public.materiales ALTER COLUMN id_proovedor DROP DEFAULT;
       public          postgres    false    220    217            �           2604    16591 "   materiales_categorias id_categoria    DEFAULT     �   ALTER TABLE ONLY public.materiales_categorias ALTER COLUMN id_categoria SET DEFAULT nextval('public.materiales_categorias_id_categoria_seq'::regclass);
 Q   ALTER TABLE public.materiales_categorias ALTER COLUMN id_categoria DROP DEFAULT;
       public          postgres    false    219    218            �           2604    16592    proovedores id    DEFAULT     p   ALTER TABLE ONLY public.proovedores ALTER COLUMN id SET DEFAULT nextval('public.proovedores_id_seq'::regclass);
 =   ALTER TABLE public.proovedores ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    222    221            2          0    16533    acta_entrada 
   TABLE DATA           n   COPY public.acta_entrada (codigo, tipo, ci_ruc, id_proovedor, factura, proceso, solicitud, fecha) FROM stdin;
    public          postgres    false    209   O       4          0    16539    acta_entrega 
   TABLE DATA           S   COPY public.acta_entrega (numero, cedula_usuario, fecha, cedula_lider) FROM stdin;
    public          postgres    false    211   �O       5          0    16544    acta_entrega_materiales 
   TABLE DATA           V   COPY public.acta_entrega_materiales (numero_acta, orden_compra, cantidad) FROM stdin;
    public          postgres    false    212   �O       6          0    16549 
   categorias 
   TABLE DATA           0   COPY public.categorias (id, nombre) FROM stdin;
    public          postgres    false    213   >P       8          0    16555    instituciones 
   TABLE DATA           3   COPY public.instituciones (id, nombre) FROM stdin;
    public          postgres    false    215   rP       9          0    16560    lideres 
   TABLE DATA           R   COPY public.lideres (cedula, nombre, apellido, cargo, id_institucion) FROM stdin;
    public          postgres    false    216   �P       :          0    16565 
   materiales 
   TABLE DATA           x   COPY public.materiales (orden_compra, descripcion, cant, valor_unitario, id_proovedor, codigo_acta_entrada) FROM stdin;
    public          postgres    false    217   �P       ;          0    16570    materiales_categorias 
   TABLE DATA           K   COPY public.materiales_categorias (orden_compra, id_categoria) FROM stdin;
    public          postgres    false    218   FQ       >          0    16577    proovedores 
   TABLE DATA           P   COPY public.proovedores (id, nombre, apellido, telefono, direccion) FROM stdin;
    public          postgres    false    221   {Q       @          0    16583    usuarios 
   TABLE DATA           a   COPY public.usuarios (cedula, nombre, apellido, correo, password, cargo, permission) FROM stdin;
    public          postgres    false    223   �Q       L           0    0    acta_entrada_id_proovedor_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.acta_entrada_id_proovedor_seq', 1, false);
          public          postgres    false    210            M           0    0    categorias_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.categorias_id_seq', 10, true);
          public          postgres    false    214            N           0    0 &   materiales_categorias_id_categoria_seq    SEQUENCE SET     U   SELECT pg_catalog.setval('public.materiales_categorias_id_categoria_seq', 1, false);
          public          postgres    false    219            O           0    0    materiales_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.materiales_id_seq', 1, false);
          public          postgres    false    220            P           0    0    proovedores_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.proovedores_id_seq', 6, true);
          public          postgres    false    222            �           2606    16594    acta_entrada acta_entrada_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.acta_entrada
    ADD CONSTRAINT acta_entrada_pkey PRIMARY KEY (codigo);
 H   ALTER TABLE ONLY public.acta_entrada DROP CONSTRAINT acta_entrada_pkey;
       public            postgres    false    209            �           2606    16596 4   acta_entrega_materiales acta_entrega_materiales_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public.acta_entrega_materiales
    ADD CONSTRAINT acta_entrega_materiales_pkey PRIMARY KEY (numero_acta, orden_compra);
 ^   ALTER TABLE ONLY public.acta_entrega_materiales DROP CONSTRAINT acta_entrega_materiales_pkey;
       public            postgres    false    212    212            �           2606    16598    acta_entrega acta_entrega_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.acta_entrega
    ADD CONSTRAINT acta_entrega_pkey PRIMARY KEY (numero);
 H   ALTER TABLE ONLY public.acta_entrega DROP CONSTRAINT acta_entrega_pkey;
       public            postgres    false    211            �           2606    16600    categorias categorias_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.categorias
    ADD CONSTRAINT categorias_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.categorias DROP CONSTRAINT categorias_pkey;
       public            postgres    false    213            �           2606    16602     instituciones instituciones_pkey 
   CONSTRAINT     ^   ALTER TABLE ONLY public.instituciones
    ADD CONSTRAINT instituciones_pkey PRIMARY KEY (id);
 J   ALTER TABLE ONLY public.instituciones DROP CONSTRAINT instituciones_pkey;
       public            postgres    false    215            �           2606    16604    lideres lideres_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.lideres
    ADD CONSTRAINT lideres_pkey PRIMARY KEY (cedula);
 >   ALTER TABLE ONLY public.lideres DROP CONSTRAINT lideres_pkey;
       public            postgres    false    216            �           2606    16606 0   materiales_categorias materiales_categorias_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public.materiales_categorias
    ADD CONSTRAINT materiales_categorias_pkey PRIMARY KEY (orden_compra, id_categoria);
 Z   ALTER TABLE ONLY public.materiales_categorias DROP CONSTRAINT materiales_categorias_pkey;
       public            postgres    false    218    218            �           2606    16608    materiales materiales_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.materiales
    ADD CONSTRAINT materiales_pkey PRIMARY KEY (orden_compra);
 D   ALTER TABLE ONLY public.materiales DROP CONSTRAINT materiales_pkey;
       public            postgres    false    217            �           2606    16610    proovedores proovedores_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.proovedores
    ADD CONSTRAINT proovedores_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.proovedores DROP CONSTRAINT proovedores_pkey;
       public            postgres    false    221            �           2606    16612    usuarios usuarios_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (cedula);
 @   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_pkey;
       public            postgres    false    223            �           2606    16613 !   materiales FK_codigo_acta_entrega    FK CONSTRAINT     �   ALTER TABLE ONLY public.materiales
    ADD CONSTRAINT "FK_codigo_acta_entrega" FOREIGN KEY (codigo_acta_entrada) REFERENCES public.acta_entrada(codigo) ON UPDATE RESTRICT ON DELETE RESTRICT NOT VALID;
 M   ALTER TABLE ONLY public.materiales DROP CONSTRAINT "FK_codigo_acta_entrega";
       public          postgres    false    3210    209    217            �           2606    16618    acta_entrega Fk_cedula_lider    FK CONSTRAINT     �   ALTER TABLE ONLY public.acta_entrega
    ADD CONSTRAINT "Fk_cedula_lider" FOREIGN KEY (cedula_lider) REFERENCES public.lideres(cedula) ON UPDATE RESTRICT ON DELETE RESTRICT NOT VALID;
 H   ALTER TABLE ONLY public.acta_entrega DROP CONSTRAINT "Fk_cedula_lider";
       public          postgres    false    3220    211    216            �           2606    16623    acta_entrega Fk_cedula_usuario    FK CONSTRAINT     �   ALTER TABLE ONLY public.acta_entrega
    ADD CONSTRAINT "Fk_cedula_usuario" FOREIGN KEY (cedula_usuario) REFERENCES public.usuarios(cedula) ON UPDATE RESTRICT ON DELETE RESTRICT;
 J   ALTER TABLE ONLY public.acta_entrega DROP CONSTRAINT "Fk_cedula_usuario";
       public          postgres    false    3228    211    223            �           2606    16628    acta_entrada Fk_di_proovedor    FK CONSTRAINT     �   ALTER TABLE ONLY public.acta_entrada
    ADD CONSTRAINT "Fk_di_proovedor" FOREIGN KEY (id_proovedor) REFERENCES public.proovedores(id) ON UPDATE RESTRICT ON DELETE RESTRICT;
 H   ALTER TABLE ONLY public.acta_entrada DROP CONSTRAINT "Fk_di_proovedor";
       public          postgres    false    209    3226    221            �           2606    16633 %   materiales_categorias Fk_id_categoria    FK CONSTRAINT     �   ALTER TABLE ONLY public.materiales_categorias
    ADD CONSTRAINT "Fk_id_categoria" FOREIGN KEY (id_categoria) REFERENCES public.categorias(id) ON UPDATE RESTRICT ON DELETE RESTRICT NOT VALID;
 Q   ALTER TABLE ONLY public.materiales_categorias DROP CONSTRAINT "Fk_id_categoria";
       public          postgres    false    3216    218    213            �           2606    16638    lideres Fk_id_instituciones    FK CONSTRAINT     �   ALTER TABLE ONLY public.lideres
    ADD CONSTRAINT "Fk_id_instituciones" FOREIGN KEY (id_institucion) REFERENCES public.instituciones(id) ON UPDATE RESTRICT ON DELETE RESTRICT NOT VALID;
 G   ALTER TABLE ONLY public.lideres DROP CONSTRAINT "Fk_id_instituciones";
       public          postgres    false    3218    216    215            �           2606    16643    materiales Fk_id_proovedor    FK CONSTRAINT     �   ALTER TABLE ONLY public.materiales
    ADD CONSTRAINT "Fk_id_proovedor" FOREIGN KEY (id_proovedor) REFERENCES public.proovedores(id) ON UPDATE RESTRICT ON DELETE RESTRICT NOT VALID;
 F   ALTER TABLE ONLY public.materiales DROP CONSTRAINT "Fk_id_proovedor";
       public          postgres    false    217    221    3226            �           2606    16648 &   acta_entrega_materiales Fk_numero_acta    FK CONSTRAINT     �   ALTER TABLE ONLY public.acta_entrega_materiales
    ADD CONSTRAINT "Fk_numero_acta" FOREIGN KEY (numero_acta) REFERENCES public.acta_entrega(numero) ON UPDATE RESTRICT ON DELETE RESTRICT;
 R   ALTER TABLE ONLY public.acta_entrega_materiales DROP CONSTRAINT "Fk_numero_acta";
       public          postgres    false    212    3212    211            �           2606    16653 %   materiales_categorias Fk_orden_compra    FK CONSTRAINT     �   ALTER TABLE ONLY public.materiales_categorias
    ADD CONSTRAINT "Fk_orden_compra" FOREIGN KEY (orden_compra) REFERENCES public.materiales(orden_compra) ON UPDATE RESTRICT ON DELETE RESTRICT NOT VALID;
 Q   ALTER TABLE ONLY public.materiales_categorias DROP CONSTRAINT "Fk_orden_compra";
       public          postgres    false    3222    217    218            �           2606    16658 '   acta_entrega_materiales Fk_orden_compra    FK CONSTRAINT     �   ALTER TABLE ONLY public.acta_entrega_materiales
    ADD CONSTRAINT "Fk_orden_compra" FOREIGN KEY (orden_compra) REFERENCES public.materiales(orden_compra) ON UPDATE RESTRICT ON DELETE RESTRICT;
 S   ALTER TABLE ONLY public.acta_entrega_materiales DROP CONSTRAINT "Fk_orden_compra";
       public          postgres    false    212    217    3222            2   n   x��;�K�����H���P���Ȉ39?��(�����ȄӔ$�@����)�sbIbN~z>P�\�4%��I��X��\�����������X#,ƚ�kF�XcS+K�=... I)P      4   X   x���1� Fᙞ�Դ-&lpc1�������������(\.�QwQ� A࢖�$�g1�-�fM�<�Vx�Q��!��x�BD���      5   2   x����su	u�u�2�uq�500�5202�LN��FƜ�\1z\\\ �	�      6   $   x�3�L,N�粀P��Ѐ3?-393/�+F��� �	�      8      x�30�00021�uu������� (��      9   +   x�32612U N���<� Μ̔�"N�#�=... ��%      :   ^   x�KN�5202200042�)J,HML�/��4�34�4��;�K�����H���+I�	gPjqn�BJ�BPo��	������N#��=... u�l      ;   %   x�KN�5202200042�4�JF�pp��qqq ��*      >   8   x�3��*M���4023�4�t/M,J�KI�2�t�OOM��-NT(�K��P����  �      @   �   x�E�Ko�@����+X���;�K�4)��t��|f� ���+M���I��kڮi1�1��\���(ʚ�z���6��-1�ɰL�c۴̋�s�2��/잮.�K!O��9}��lL�ěϗ�)�F@�� z��=\!4�'���̱]}�A���ȕ��,�����XB�RГ,(/�r�ţ����#X� _;y��s��q�����per���sn�p�F�T-�Y0��$��N5M�8�[O     