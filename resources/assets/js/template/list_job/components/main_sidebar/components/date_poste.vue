<template>
    <div class="panel panel-white">
        <div class="panel-heading">
            <div class="panel-title text-semibold">
                <i class="icon-calendar3 position-left"></i>
                Date posted
            </div>
        </div>

        <form action="#">
            <div class="panel-body">
                <div class="form-group">
                    <div class="radio no-margin-top">
                        <label>
                            <input type="radio" name="when_posted" class="styled">
                            Today
                            <span class="text-muted text-size-small">&nbsp;(632)</span>
                        </label>
                    </div>

                    <div class="radio">
                        <label>
                            <input type="radio" name="when_posted" class="styled">
                            Yesterday
                            <span class="text-muted text-size-small">&nbsp;(431)</span>
                        </label>
                    </div>

                    <div class="radio">
                        <label>
                            <input type="radio" name="when_posted" class="styled">
                            Last week
                            <span class="text-muted text-size-small">&nbsp;(31)</span>
                        </label>
                    </div>

                    <div class="radio">
                        <label>
                            <input type="radio" name="when_posted" class="styled">
                            Last month
                            <span class="text-muted text-size-small">&nbsp;(124)</span>
                        </label>
                    </div>

                    <div class="radio no-margin-bottom">
                        <label>
                            <input type="radio" name="when_posted" class="styled">
                            Any time
                        </label>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>