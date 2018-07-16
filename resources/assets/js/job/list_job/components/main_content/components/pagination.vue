<template>
    <div class="text-center content-group-lg pt-20">
        <ul class="pagination">
            <li @click="downPage" :class="checkPre"><a href="#"><i class="icon-arrow-small-left"></i></a></li>
            <li v-for="page in total_page" :class="checkActive(page)" @click="select_page(page)"><a href="#">{{page}}</a></li>
            <li @click="upPage" :class="checkNext"><a href="#"><i class="icon-arrow-small-right"></i></a></li>
        </ul>
    </div>
</template>
<script>
    export default {
        computed: {
            checkPre()
            {
                if(this.current_page == 1)
                {
                    return 'disabled'
                }
            },
            checkNext()
            {
                if(this.current_page == this.total_page)
                {
                    return 'disabled'
                }
            }
        },
        props: ['total_page','current_page'],
        methods: {
          checkActive(page)
          {
              if(page == this.current_page)
              {
                  return 'active'
              }
          },
            select_page(page){
              this.$emit('set_current_page',page)
            },
            downPage(){
               if(this.current_page > 1)
               {
                   this.$emit('set_current_page',this.current_page - 1)
               }

            },
            upPage(){
              if(this.current_page < this.total_page)
              {
                  this.$emit('set_current_page',this.current_page + 1)
              }
            }

        },
    }
</script>