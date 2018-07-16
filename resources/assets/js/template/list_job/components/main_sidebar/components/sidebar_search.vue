<template>
    <div class="panel panel-white">
        <div class="panel-heading">
            <div class="panel-title text-semibold">
                <i class="icon-search4 text-size-base position-left"></i>
                Filter
            </div>
        </div>

        <div class="panel-body">
            <form action="#">
                <div class="form-group">
                    <div class="has-feedback has-feedback-left">
                        <input type="search" class="form-control" placeholder="Job title or keywords">
                        <div class="form-control-feedback">
                            <i class="icon-reading text-size-large text-muted"></i>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="has-feedback has-feedback-left">
                        <input type="search" class="form-control" placeholder="Location">
                        <div class="form-control-feedback">
                            <i class="icon-pin-alt text-size-large text-muted"></i>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="checkbox">
                        <label class="display-block">
                            <input type="checkbox" class="styled">
                            Full time
                        </label>
                    </div>

                    <div class="checkbox">
                        <label class="display-block">
                            <input type="checkbox" class="styled">
                            Part time
                        </label>
                    </div>

                    <div class="checkbox">
                        <label class="display-block">
                            <input type="checkbox" class="styled">
                            Remote
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn bg-blue btn-block">
                    <i class="icon-search4 text-size-base position-left"></i>
                    Find jobs
                </button>
            </form>
        </div>
    </div>
</template>