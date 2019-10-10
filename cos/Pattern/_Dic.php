<?php
    # 21 August 2018 - Dic pattern : Dependency Injection Container 
    # Try to solve injection dependencies while initiliazing a class wjich need another instane to run.
    namespace Cos\Pattern{
        
        class _Dic {

            private $registry   = [];
            private $factories  = [];
            private $_instances = [];

            public function set(string $key, callable $resolver) : void
            {
                $this->registry[$key] = $resolver;
            }
            
            public function setFactory(string $key, callable $resolver){
                $this->factories[$key] = $resolver;
            }

            public function setInstance($_instance){
                # \ReflectionClass : Default Php Class ,  
                $mirror = new \ReflectionClass($_instance);
                $this->_instances[$mirror->getName()] = $_instance ;
                
                #$this->debug($reflection->getConstructor()->class);
            }

            public function get(string $key){
                # @if the key was setted via setFactory()  method<- escaping singleton pattern
                if (isset($this->factories[$key]))
                {
                   return $this->factories[$key]();
                }
                # @if the key was setted via set() Method Singleton pattern 
                if (!isset($this->_instances[$key])) 
                {
                    if(isset($this->registry[$key]))
                    {
                        $this->_instances[$key] = $this->registry[$key]();
                    }else{
                        # Solving problem of unexisting key ...
                        $mirror_class = new \ReflectionClass($key);
                        if ($mirror_class->isInstantiable()){
                            
                            $constructor = $mirror_class->getConstructor();
                            if($constructor)
                            {
                                $parameters  = $constructor->getParameters();
                                $constructor_parameters = [];
    
                                foreach($parameters as $parameter){
                                   if ($parameter->getClass())
                                   {
                                       # Recursion
                                       $constructor_parameters[] = $this->get($parameter->getClass()->getName());
                                   }else{
                                       $constructor_parameters[] = $parameter->getDefaultValue();
                                   }
                                    
                                }
                                # $this->debug($constructor_parameters, true); 
                                $this->_instances[$key] = $mirror_class->newInstanceArgs($constructor_parameters);
                            }else{
                                $this->_instances[$key] = $mirror_class->newInstance();
                            }
                           
                        }else{
                            throw new \Exception('This Key '.$key.' Class is not instanciable');
                        }
                     
                   }
                  
                }
              
               return $this->_instances[$key];

            }
            public function debug($to_debug,$dump = false){
                if($dump){
                    var_dump('<pre>',$to_debug,'</pre>');
                }else{
                    echo '<pre>'.print_r($to_debug,true).'</pre>';
                }
                die();
            }


        }

    }

?>